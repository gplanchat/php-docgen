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

class ParameterWriter
{
        public function export(Docgen\ParameterEntry $parameterEntry, $currentLevel = 1)
    {
        $isNullable = $parameterEntry->getIsNullable() ? 'Yes' : 'No';
        if ($currentLevel === 1) {
            $buffer = <<<TITLE_EOF
Parameter `{$parameterEntry->getName()}`
==========

{$parameterEntry->getDescription()}
* *type* : {$parameterEntry->getType()}
* *is nullable* : {$isNullable}\n
TITLE_EOF;
        } else {
            $dashes = str_pad('', $currentLevel, '#', \STR_PAD_RIGHT);
            $buffer = <<<TITLE_EOF
{$dashes } Parameter `{$parameterEntry->getName()}`

{$parameterEntry->getDescription()}
* *type* : {$parameterEntry->getType()}
* *is nullable* : {$isNullable}\n
TITLE_EOF;
        }

        if ($parameterEntry->hasDefaultValue()) {
            $defaultValue = var_export($parameterEntry->getDefaultValue(), true);
            if (($constant = $parameterEntry->getDefaultValueConstant()) !== null) {
                $buffer .= "* *default value* : `{$constant}` = `{$defaultValue}`\n";
            } else {
                $buffer .= "* *default value* : `{$defaultValue}`\n";
            }
        }

        return $buffer;
    }
}
