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

/**
 * Extension entry manager.
 *
 * @package Gplanchat\Docgen
 */
class ExtensionEntry
    implements EntryInterface
{
    use EntryTrait;
    use NamespaceAwareTrait;
    use ClassAwareTrait;
    use ConstantAwareTrait;
    use FunctionAwareTrait;

    /**
     * Generate documentation for a PHP native extension
     *
     * @param \ReflectionExtension $re
     * @return $this
     */
    public function parse(\ReflectionExtension $re)
    {
        if ($re === null) {
            $re = new \ReflectionExtension($this->getName());
        }

        foreach ($re->getConstants() as $constantName => $constantValue) {
            $constantEntry = new ConstantEntry($constantName, $this);
            $constantEntry->setValue($constantValue);
            $this->addConstant($constantEntry);
        }

        foreach ($re->getFunctions() as $function) {
            $functionEntry = new FunctionEntry($function->getName(), $this);
            $functionEntry->parse($function);
            $this->addFunction($functionEntry);
        }

        foreach ($re->getClasses() as $class) {
            $classEntry = new ClassEntry($class->getName(), $this);
            $classEntry->parse($class);
            $this->addFunction($classEntry);
        }

        return $this;
    }
}
