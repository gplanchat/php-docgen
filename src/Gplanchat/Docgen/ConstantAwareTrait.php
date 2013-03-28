<?php

namespace Gplanchat\Docgen;

trait ConstantAwareTrait
{
    private $constants = [];

    public function setConstants(array $constants)
    {
        $this->constants = $constants;

        return $this;
    }

    public function addConstant(ConstantEntry $constantEntry)
    {
        $this->constants[] = $constantEntry;

        return $this;
    }

    public function getConstants()
    {
        return $this->constants;
    }
}
