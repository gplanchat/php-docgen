<?php
/**
 * This file is part of Gplanchat\Docgen.
 *
 * Gplanchat\Docgen is free software: you can redistribute it and/or modify
 * it under the terms of the GNU LEsser General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Gplanchat\Docgen is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Gplanchat\Docgen.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Grégory PLANCHAT <g.planchat@gmail.com>
 * @license Lesser General Public License v3 (http://www.gnu.org/licenses/lgpl-3.0.txt)
 * @copyright Copyright (c) 2013 Grégory PLANCHAT (http://planchat.fr/)
 */

namespace Gplanchat\Docgen;

class FileEntry
    implements EntryInterface
{
    use EntryTrait;
    use NamespaceAwareTrait;
    use ClassAwareTrait;
    use ConstantAwareTrait;
    use FunctionAwareTrait;

    public function parse()
    {
        $it = new \ArrayIterator(token_get_all(file_get_contents($this->getName())));

        $namespaceName = '';
        $currentNamespace = new NamespaceEntry($namespaceName);
        $this->addNamespace($currentNamespace);

        for ($it->rewind(); $it->valid(); $it->next()) {
            $token = $it->current();

            if (!is_array($token)) {
                continue;
            }

            if ($token[0] === \T_NAMESPACE) {
                $namespaceName = '';
                for ($it->next(); $it->valid(); $it->next()) {
                    $token = $it->current();
                    if ($token[0] === \T_WHITESPACE) {
                        continue;
                    }
                    if (!is_array($token) || ($token[0] !== \T_STRING && $token[0] !== \T_NS_SEPARATOR)) {
                        break;
                    }

                    $namespaceName .= $token[1];
                }

                if (($componentEntry = $this->getParentEntry()) !== null) {
                    /** @var ComponentEntry $componentEntry */
                    if (($currentNamespace = $componentEntry->getNamespace($namespaceName)) === null) {
                        $currentNamespace = new NamespaceEntry($namespaceName, $this);
                        $this->addNamespace($currentNamespace);
                        $componentEntry->addNamespace($currentNamespace);
                    }
                } else if (($currentNamespace = $this->getNamespace($namespaceName)) === null) {
                    $currentNamespace = new NamespaceEntry($namespaceName, $this);
                    $this->addNamespace($currentNamespace);
                }
                continue;
            }

            if ($token[0] === \T_CLASS || $token[0] === \T_INTERFACE || $token[0] === \T_TRAIT) {
                $type = $token[0];
                for ($it->next(); $it->valid(); $it->next()) {
                    $token = $it->current();
                    if (!is_array($token) || $token[0] === \T_WHITESPACE) {
                        continue;
                    }
                    if ($token[0] !== \T_STRING) {
                        break;
                    }

                    $classEntry = new ClassEntry($token[1], $currentNamespace);
                    $classEntry->setType($type);
                    $currentNamespace->addClass($classEntry);
                    $this->addClass($classEntry);

                    $classEntry->parse();
                }
            }
        }

        return $this;
    }
}
