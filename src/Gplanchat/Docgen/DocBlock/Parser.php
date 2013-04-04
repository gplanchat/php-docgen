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

namespace Gplanchat\Docgen\DocBlock;

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
            $line = trim($line);
            if (empty($line)) {
                if ($type !== 'description') {
                    $type = null;
                }
                continue;
            }

            if (preg_match('#^@(\w+)\s(.*)$#', $line, $match)) {
                $type = \strtolower($match[1]);
                $line = trim($match[2]);
            }

            if ($type !== null) {
                $this->appendDeclaration($type, $line);
            }
        }
        unset($buffer);

        return $this;
    }

    public function appendDeclaration($type, $data)
    {
        switch ($type) {
            case 'description':
                if (!isset($this[$type])) {
                    $this[$type] = $data;
                } else {
                    $this[$type] .= ' ' . $data;
                }
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
