<?php

namespace Gplanchat\Docgen;

trait EntryTrait
{
    /**
     * @var string
     */
    private $name = null;

    /**
     * @var string
     */
    private $description = null;

    /**
     * @var EntryInterface|null
     */
    private $parentEntry = null;

    /**
     * @param string $name
     * @param EntryInterface $parent
     */
    public function __construct($name, EntryInterface $parentEntry = null)
    {
        $this->setName($name);
        if ($parentEntry !== null) {
            $this->setParentEntry($parentEntry);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return EntryInterface
     */
    public function getParentEntry()
    {
        return $this->parentEntry;
    }

    /**
     * @param EntryInterface $parent
     * @return $this
     */
    public function setParentEntry(EntryInterface $parent)
    {
        $this->parentEntry = $parent;

        return $this;
    }
}
