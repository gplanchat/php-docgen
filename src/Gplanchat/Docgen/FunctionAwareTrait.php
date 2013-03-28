<?php

namespace Gplanchat\Docgen;

trait FunctionAwareTrait
{
    private $functions = [];

    public function setFunctions(array $functions)
    {
        $this->functions = $functions;

        return $this;
    }

    public function addFunction(FunctionEntry $functionEntry)
    {
        $this->functions[] = $functionEntry;

        return $this;
    }

    public function getFunctions()
    {
        return $this->functions;
    }
}
