<?php

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
