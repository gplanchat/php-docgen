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
