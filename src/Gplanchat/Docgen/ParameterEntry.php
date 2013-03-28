<?php

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
