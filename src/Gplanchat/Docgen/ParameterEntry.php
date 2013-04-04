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

class ParameterEntry
    implements EntryInterface
{
    use EntryTrait;

    private $type = null;
    private $hasDefaultValue = false;
    private $defaultValue = null;
    private $defaultValueConstant = null;
    private $isNullable = false;

    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        $this->hasDefaultValue = true;

        return $this;
    }

    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    public function hasDefaultValue()
    {
        return (bool) $this->hasDefaultValue;
    }

    public function unsetDefaultValue()
    {
        $this->hasDefaultValue = false;
        $this->defaultValue = null;

        return $this;
    }

    public function setDefaultValueConstant($defaultValueConstant)
    {
        $this->defaultValueConstant = $defaultValueConstant;

        return $this;
    }

    public function getDefaultValueConstant()
    {
        return $this->defaultValueConstant;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setIsNullable($isNullable)
    {
        $this->isNullable = (bool) $isNullable;

        return $this;
    }

    public function getIsNullable()
    {
        return $this->isNullable;
    }

    public function parse(\ReflectionParameter $re)
    {
        if ($re->isArray()) {
            $this->setType('array');
        } else if ($re->isCallable()) {
            $this->setType('callable');
        } else if ($class = $re->getDeclaringClass()) {
            $this->setType($class->getName());
        }

        if ($re->isDefaultValueAvailable()) {
            $this->setDefaultValue($re->getDefaultValue());

            if ($re->isDefaultValueConstant()) {
                $this->setDefaultValueConstant($re->getDefaultValueConstantName());
            }
        }
        $this->setIsNullable($re->allowsNull());

        return $this;
    }
}
