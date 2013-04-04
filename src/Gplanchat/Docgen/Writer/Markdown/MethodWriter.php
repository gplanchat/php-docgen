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

class MethodWriter
{
    public function export(Docgen\MethodEntry $methodEntry, $currentLevel = 1, $maxLevel = 5)
    {
        if ($currentLevel === 1) {
            $buffer = <<<TITLE_EOF
Method `{$methodEntry->getName()}`
==========

{$methodEntry->getDescription()}
TITLE_EOF;
        } else {
            $dashes = str_pad('', 1 + $currentLevel, '#', \STR_PAD_RIGHT);
            $buffer = <<<TITLE_EOF
$dashes Method `{$methodEntry->getName()}`

{$methodEntry->getDescription()}
\n
TITLE_EOF;
        }
        $currentLevel++;

        if ($currentLevel <= $maxLevel) {
            if (count($parameterList = $methodEntry->getParameters()) > 0) {
                $parameterWriter = new ParameterWriter();
                foreach ($parameterList as $parameterEntry) {
                    /** @var Docgen\ParameterEntry $parameterEntry */
                    $buffer .= $parameterWriter->export($parameterEntry, $currentLevel + 1, $maxLevel);
                    $buffer .= "\n\n";
                }
            }
        }

        return $buffer;
    }
}
