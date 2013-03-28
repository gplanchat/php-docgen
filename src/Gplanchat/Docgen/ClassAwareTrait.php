<?php

namespace Gplanchat\Docgen;

trait ClassAwareTrait
{
    private $classes = [];

    public function setClasses(array $classes)
    {
        $this->classes = $classes;

        return $this;
    }

    public function addClass(ClassEntry $classEntry)
    {
        $this->classes[] = $classEntry;

        return $this;
    }

    public function getClasses()
    {
        return $this->classes;
    }
}
