<?php

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
TITLE_EOF;
        }
        $currentLevel++;

        if ($currentLevel <= $maxLevel) {
            if (count($parameterList = $methodEntry->getParameters()) > 0) {
                $parameterWriter = new ParameterWriter();
                foreach ($parameterList as $parameterEntry) {
                    /** @var Docgen\ParameterEntry $parameterEntry */
                    $buffer .= $parameterWriter->export($parameterEntry, $currentLevel + 1, $maxLevel);
                }
                $buffer .= "\n\n";
            }
        }

        return $buffer;
    }
}
