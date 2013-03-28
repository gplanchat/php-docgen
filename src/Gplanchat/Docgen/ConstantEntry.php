<?php

namespace Gplanchat\Docgen;

class ConstantEntry
    implements EntryInterface
{
    use EntryTrait;

    private $value = null;

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }
}
