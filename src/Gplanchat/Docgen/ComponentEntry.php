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
 * Component entry manager. A component is a group of namespaces and/or
 * classes and/or functions grouped as a whole that builds a feature.
 *
 * Class ComponentEntry
 * @package Gplanchat\Docgen
 */
class ComponentEntry
    implements EntryInterface
{
    use EntryTrait;
    use FileAwareTrait;
    use NamespaceAwareTrait;
    use ClassAwareTrait;
    use ConstantAwareTrait;
    use FunctionAwareTrait;

    /**
     * Parse a directory path, searching for
     *
     * @param $sourcePath
     * @return $this
     */
    public function parse($sourcePath)
    {
        $it = new \RecursiveDirectoryIterator($sourcePath, \RecursiveDirectoryIterator::KEY_AS_PATHNAME | \RecursiveDirectoryIterator::CURRENT_AS_SELF);
        foreach (new \RecursiveIteratorIterator($it) as $path => $fsEntry) {
            /** @var \SplFileInfo $fsEntry */
            if ($fsEntry->isDir()) {
                continue;
            }

            $this->addFile($fileEntry = new FileEntry($path, $this));
            $fileEntry->parse();
        }

        return $this;
    }
}
