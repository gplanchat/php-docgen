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

trait FileAwareTrait
{
    private $files = [];

    public function setFiles(array $files)
    {
        $this->files = $files;

        return $this;
    }

    public function addFile(FileEntry $fileEntry)
    {
        $this->files[$fileEntry->getName()] = $fileEntry;

        return $this;
    }

    public function getFiles()
    {
        return $this->files;
    }

    public function hasFile($fileName)
    {
        return isset($this->files[$fileName]);
    }

    public function getFile($fileName)
    {
        if ($this->hasFile($fileName)) {
            return $this->files[$fileName];
        }

        return null;
    }
}
