<?php

namespace Gplanchat\Docgen;

trait ParameterAwareTrait
{
    private $parameters = [];

    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function addParameter(ParameterEntry $parameterEntry)
    {
        $this->parameters[] = $parameterEntry;

        return $this;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}
