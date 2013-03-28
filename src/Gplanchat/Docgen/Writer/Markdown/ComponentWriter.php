<?php

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
                    $buffer .= "* {$fileEntry->getName()}\n";
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
