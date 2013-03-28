<?php

namespace Gplanchat\Docgen;

class ComponentEntry
    implements EntryInterface
{
    use EntryTrait;
    use FileAwareTrait;
    use NamespaceAwareTrait;
    use ClassAwareTrait;
    use ConstantAwareTrait;
    use FunctionAwareTrait;

    public function parse($sourcePath)
    {
        $it = new \RecursiveDirectoryIterator($sourcePath, \RecursiveDirectoryIterator::KEY_AS_PATHNAME | \RecursiveDirectoryIterator::CURRENT_AS_SELF);
        foreach (new \RecursiveIteratorIterator($it) as $path => $fsEntry) {
            /** @var \SplFileInfo $fsEntry */
            if ($fsEntry->isDir()) {
                continue;
            }

            $this->addFile($fileEntry = new FileEntry($path, $this));
            $fileEntry->parse();
        }

        return $this;
    }
}
