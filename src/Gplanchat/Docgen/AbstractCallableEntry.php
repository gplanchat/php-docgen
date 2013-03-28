<?php

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
     * @var null|string
     */
    private $returnType = null;

    /**
     * Define the callable return type
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
     * Get the callable return type
     *
     * @return null|string
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

}
