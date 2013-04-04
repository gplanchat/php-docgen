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
namespace Gplanchat\Docgen\Writer\Markdown;

use Gplanchat\Docgen;

class ComponentWriter
{
    public function export(Docgen\ComponentEntry $componentEntry, $currentLevel = 1, $maxLevel = 5)
    {
        if ($currentLevel === 1) {
            $buffer = <<<TITLE_EOF
Component {$componentEntry->getName()}
==========

{$componentEntry->getDescription()}
\n
TITLE_EOF;
        } else {
            $dashes = str_pad('', $currentLevel, '#', \STR_PAD_RIGHT);
            $buffer = <<<TITLE_EOF
$dashes Compnent `{$componentEntry->getName()}`

{$componentEntry->getDescription()}
\n
TITLE_EOF;
        }
        $currentLevel++;

        if ($currentLevel <= $maxLevel) {
            if (($fileList = $componentEntry->getFiles()) !== null) {
                $buffer .= "## Files\n\n";
                foreach ($fileList as $fileEntry) {
                    /** @var Docgen\FileEntry $fileEntry */
                    $filename = str_replace(DIRECTORY_SEPARATOR, '/', $fileEntry->getName());
                    $buffer .= "* {$filename}\n";
                }
                $buffer .= "\n\n";
            }

            if (($namespaceList = $componentEntry->getNamespaces()) !== null) {
                $buffer .= "## Documentation\n\n";
                $namespaceWriter = new NamespaceWriter();
                foreach ($namespaceList as $namespaceEntry) {
                    /** @var Docgen\NamespaceEntry $namespaceEntry */

                    $buffer .= $namespaceWriter->export($namespaceEntry, $currentLevel + 1, $maxLevel);
                }
                $buffer .= "\n\n";
            }
        }

        return $buffer;
    }
}
