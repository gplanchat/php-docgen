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

namespace Gplanchat\Docgen;

/**
 * Base class for callable entries (methods and functions).
 *
 * @package Gplanchat\Docgen
 */
abstract class AbstractCallableEntry
    implements EntryInterface
{
    use EntryTrait;
    use ParameterAwareTrait;

    /**
     * callable's return type
     *
     * @var null|string
     */
    private $returnType = null;

    /**
     * Defines the callable's return type
     *
     * @param string $returnType
     * @return $this
     */
    public function setReturnType($returnType)
    {
        $this->returnType = $returnType;

        return $this;
    }

    /**
     * Get the callable's return type
     *
     * @return null|string
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * @param \ReflectionFunctionAbstract $re
     * @return $this
     */
    public function parse(\ReflectionFunctionAbstract $re)
    {
        foreach ($re->getParameters() as $parameter) {
            $parameterEntry = new ParameterEntry($parameter->getName(), $this);
            $parameterEntry->parse($parameter);
            $this->addParameter($parameterEntry);
        }

        if (($docComment = $re->getDocComment()) !== false) {
            $parser = new DocBlock\Parser();
            $parser->parse($docComment);

            if (isset($parser['description'])) {
                $this->setDescription($parser['description']);
            }
        }

        return $this;
    }
}
