<?php

namespace Gplanchat\Docgen;

interface EntryInterface
{
    /**
     * @param string $name
     * @param EntryInterface $parent
     */
    public function __construct($name, EntryInterface $parent = null);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * @return EntryInterface
     */
    public function getParentEntry();

    /**
     * @param EntryInterface $parent
     * @return $this
     */
    public function setParentEntry(EntryInterface $parent);
}
