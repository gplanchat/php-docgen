<?php

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
            $buffer = <<<TITLE_EOF
Parameter `{$parameterEntry->getName()}`

{$parameterEntry->getDescription()}

* *type* : {$parameterEntry->getType()}
* *is nullable* : {$isNullable}\n
TITLE_EOF;
        }

        if ($parameterEntry->hasDefaultValue()) {
            $defaultValue = var_export($parameterEntry->getDefaultValue(), true);
            if (($constant = $parameterEntry->getDefaultValueConstant()) !== null) {
                $buffer .= "* *default value* : `{$constant}` = `{$defaultValue}`";
            } else {
                $buffer .= "* *default value* : `{$defaultValue}`";
            }
        }

        $buffer .= "\n\n";

        return $buffer;
    }
}
