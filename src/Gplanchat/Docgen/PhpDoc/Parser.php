<?php

namespace Gplanchat\Docgen\PhpDoc;

class Parser
    extends \ArrayObject
{
    public function parse($comment)
    {
        if (preg_match('#^/\*\*(.*)\*/#s', $comment, $match) === false) {
            throw new \UnexpectedValueException('Wrong doc comment format.');
        }
        $commentData = trim($match[1]);

        if (preg_match_all('#^\s*\*(.*)#m', $commentData, $linesMatches) === false) {
            throw new \UnexpectedValueException('Empty doc comment.');
        }

        array_walk($linesMatches[1], function(&$line) {
            $line = trim($line);
        });

        $type = 'description';
        foreach ($linesMatches[1] as $line) {
            if (preg_match('#^@(\w+)\s(.*)$#', $line, $match)) {
                $type = \strtolower($match[1]);
                $line = trim($match[2]);
            }

            $this->appendDeclaration($type, $line);
        }
        unset($buffer);

        return $this;
    }

    public function appendDeclaration($type, $data)
    {
        switch ($type) {
            case 'description':
                if (!isset($this[$type])) {
                    $this[$type] = '';
                }
                $this[$type] .= ' ' . $data;
                break;

            default:
                if (!isset($this[$type])) {
                    $this[$type] = [];
                }
                $this[$type][] = $data;
                break;
        }

        return $this;
    }
}
