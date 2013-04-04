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

class NamespaceWriter
{
    public function export(Docgen\NamespaceEntry $namespaceEntry, $currentLevel = 1, $maxLevel = 5)
    {
        if (($name = $namespaceEntry->getName()) == '') {
            $titleLine = 'Root namespace';
        } else {
            $titleLine = "Namespace `{$name}`";
        }
        if ($currentLevel === 1) {
            $buffer = <<<TITLE_EOF
{$titleLine}
==========

{$namespaceEntry->getDescription()}
\n
TITLE_EOF;
        } else {
            $dashes = str_pad('', $currentLevel, '#', \STR_PAD_RIGHT);
            $buffer = <<<TITLE_EOF
{$dashes} {$titleLine}

{$namespaceEntry->getDescription()}
\n
TITLE_EOF;
        }
        $currentLevel++;

        if ($currentLevel <= $maxLevel) {
            if (count($constantList = $namespaceEntry->getConstants()) > 0) {
                $dashes = str_pad('', $currentLevel, '#', \STR_PAD_RIGHT);
                $buffer .= "$dashes Constants\n\n";
                $constantWriter = new ConstantWriter();
                foreach ($constantList as $constantEntry) {
                    /** @var Docgen\ConstantEntry $constantEntry */
                    $buffer .= $constantWriter->export($constantEntry, $currentLevel + 1);
                }
            }

            if (count($classList = $namespaceEntry->getClasses()) > 0) {
                $dashes = str_pad('', $currentLevel, '#', \STR_PAD_RIGHT);
                $buffer .= "$dashes Classes\n\n";
                $classWriter = new ClassWriter();
                foreach ($classList as $classEntry) {
                    /** @var Docgen\ClassEntry $classEntry */
                    $buffer .= $classWriter->export($classEntry, $currentLevel + 1, $maxLevel);
                }
            }
        }

        return $buffer;
    }
}
