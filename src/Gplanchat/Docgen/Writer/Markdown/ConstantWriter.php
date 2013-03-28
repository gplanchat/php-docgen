<?php

namespace Gplanchat\Docgen\Writer\Markdown;

use Gplanchat\Docgen;

class ConstantWriter
{
    public function export(Docgen\ConstantEntry $constantEntry, $currentLevel = 1)
    {
        $constantValue = var_export($constantEntry->getValue(), true);
        if ($currentLevel === 1) {
            $buffer = <<<TITLE_EOF
Constant `{$constantEntry->getName()}`
==========

*Value* : `{$constantValue}`

{$constantEntry->getDescription()}
\n
TITLE_EOF;
        } else {
            $dashes = str_pad('', $currentLevel, '#', \STR_PAD_RIGHT);
            $buffer = <<<TITLE_EOF
$dashes Constant `{$constantEntry->getName()}`

*Value* : `{$constantValue}`

{$constantEntry->getDescription()}
\n
TITLE_EOF;
        }

        return $buffer;
    }
}
