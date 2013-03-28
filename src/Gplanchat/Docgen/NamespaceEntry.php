<?php

namespace Gplanchat\Docgen;

class NamespaceEntry
    implements EntryInterface
{
    use EntryTrait;
    use ClassAwareTrait;
    use ConstantAwareTrait;
    use FunctionAwareTrait;
}
