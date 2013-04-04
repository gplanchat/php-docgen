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

/**
 * Trait designed for entries containing classes
 *
 * @package Gplanchat\Docgen
 */
trait ClassAwareTrait
{
    /**
     * Class entries list
     *
     * @var array
     */
    private $classes = [];

    /**
     * Define a new class entries list
     *
     * @param array $classes
     * @return $this
     */
    public function setClasses(array $classes)
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * Add a new class entry to the list
     *
     * @param ClassEntry $classEntry
     * @return $this
     */
    public function addClass(ClassEntry $classEntry)
    {
        $this->classes[] = $classEntry;

        return $this;
    }

    /**
     * Get all class entries in the list
     *
     * @return array
     */
    public function getClasses()
    {
        return $this->classes;
    }
}
