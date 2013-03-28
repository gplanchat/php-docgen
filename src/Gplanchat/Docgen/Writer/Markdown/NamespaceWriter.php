<?php

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
