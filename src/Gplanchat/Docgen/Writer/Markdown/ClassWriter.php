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

class ClassWriter
{
    public function export(Docgen\ClassEntry $classEntry, $currentLevel = 1, $maxLevel = 5)
    {
        $type = $classEntry->getType() === T_TRAIT ? 'Trait' : ($classEntry->getType() === T_INTERFACE ? 'Interface' :'Class');
        $namespace = '';
        $link = '';
        if (($namespaceEntry = $classEntry->getParentEntry()) !== null) {
            $filename = str_replace('\\', '-', $namespaceEntry->getName()) . '.md';
            $anchor = \strtolower($type . '-' . $classEntry->getName());
            $link = "[» Read the docs]({$filename}#{$anchor})";

            $namespace .= <<<NAMESPACE_EOL
\n_Declared in namespace `{$namespaceEntry->getName()}`_ {$link}\n
NAMESPACE_EOL;
        }

        if ($currentLevel === 1) {
            $buffer = <<<TITLE_EOF
{$type} `{$classEntry->getName()}`
==========
{$namespace}
{$classEntry->getDescription()}
\n
TITLE_EOF;
        } else {
            $dashes = str_pad('', $currentLevel, '#', \STR_PAD_RIGHT);
            $buffer = <<<TITLE_EOF
$dashes {$type} `{$classEntry->getName()}`
{$namespace}
{$classEntry->getDescription()}
\n
TITLE_EOF;
        }

        if ($currentLevel <= $maxLevel) {
            if (count($interfaceList = $classEntry->getParentInterfaces()) > 0) {
                $dashes = str_pad('', $currentLevel + 1, '#', \STR_PAD_RIGHT);
                $buffer .= "$dashes Implemented Interfaces\n\n";
                foreach ($interfaceList as $interfaceName) {
                    $buffer .= "* `$interfaceName`\n";
                }
                $buffer .= "\n\n";
            }

            if (count($traitsList = $classEntry->getUsedTraits()) > 0) {
                $dashes = str_pad('', $currentLevel + 1, '#', \STR_PAD_RIGHT);
                $buffer .= "$dashes Used Traits\n\n";
                foreach ($traitsList as $traitName) {
                    $buffer .= "* `$traitName`\n";
                }
                $buffer .= "\n\n";
            }

            if (count($constantList = $classEntry->getConstants()) > 0) {
                $constantWriter = new ConstantWriter();
                foreach ($constantList as $constantEntry) {
                    /** @var Docgen\ConstantEntry $constantEntry */
                    $buffer .= $constantWriter->export($constantEntry, $currentLevel);
                }
                $buffer .= "\n\n";
            }

            if (count($parameterList = $classEntry->getParameters()) > 0) {
                $parameterWriter = new ParameterWriter();
                foreach ($parameterList as $parameterEntry) {
                    /** @var Docgen\ParameterEntry $parameterEntry */
                    $buffer .= $parameterWriter->export($parameterEntry, $currentLevel);
                }
                $buffer .= "\n\n";
            }

            if (count($methodList = $classEntry->getMethods()) > 0) {
                $methodWriter = new MethodWriter();
                foreach ($methodList as $methodEntry) {
                    /** @var Docgen\MethodEntry $methodEntry */
                    $buffer .= $methodWriter->export($methodEntry, $currentLevel, $maxLevel);
                }
                $buffer .= "\n\n";
            }
        }

        return $buffer;
    }
}
