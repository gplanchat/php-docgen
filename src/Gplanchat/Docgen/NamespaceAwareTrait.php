<?php

namespace Gplanchat\Docgen;

trait NamespaceAwareTrait
{
    private $namespaces = [];

    public function setNamespaces(array $namespaces)
    {
        $this->namespaces = $namespaces;

        return $this;
    }

    public function addNamespace(NamespaceEntry $namespaceEntry)
    {
        $this->namespaces[$namespaceEntry->getName()] = $namespaceEntry;

        return $this;
    }

    public function getNamespaces()
    {
        return $this->namespaces;
    }

    public function hasNamespace($namespaceName)
    {
        return isset($this->namespaces[$namespaceName]);
    }

    public function getNamespace($namespaceName)
    {
        if ($this->hasNamespace($namespaceName)) {
            return $this->namespaces[$namespaceName];
        }

        return null;
    }
}
