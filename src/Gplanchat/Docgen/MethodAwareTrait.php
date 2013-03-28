<?php

namespace Gplanchat\Docgen;

trait MethodAwareTrait
{
    private $methods = [];

    public function setMethods(array $methods)
    {
        $this->methods = $methods;

        return $this;
    }

    public function addMethod(MethodEntry $methodEntry)
    {
        $this->methods[] = $methodEntry;

        return $this;
    }

    public function getMethods()
    {
        return $this->methods;
    }
}
