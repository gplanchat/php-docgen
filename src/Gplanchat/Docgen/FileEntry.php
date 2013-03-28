<?php

namespace Gplanchat\Docgen;

class FileEntry
    implements EntryInterface
{
    use EntryTrait;
    use NamespaceAwareTrait;
    use ClassAwareTrait;
    use ConstantAwareTrait;
    use FunctionAwareTrait;

    public function parse()
    {
        $it = new \ArrayIterator(token_get_all(file_get_contents($this->getName())));

        $namespaceName = '';
        $currentNamespace = new NamespaceEntry($namespaceName);
        $this->addNamespace($currentNamespace);

        for ($it->rewind(); $it->valid(); $it->next()) {
            $token = $it->current();

            if (!is_array($token)) {
                continue;
            }

            if ($token[0] === \T_NAMESPACE) {
                $namespaceName = '';
                for ($it->next(); $it->valid(); $it->next()) {
                    $token = $it->current();
                    if ($token[0] === \T_WHITESPACE) {
                        continue;
                    }
                    if (!is_array($token) || ($token[0] !== \T_STRING && $token[0] !== \T_NS_SEPARATOR)) {
                        break;
                    }

                    $namespaceName .= $token[1];
                }

                if (($componentEntry = $this->getParentEntry()) !== null) {
                    /** @var ComponentEntry $componentEntry */
                    if (($currentNamespace = $componentEntry->getNamespace($namespaceName)) === null) {
                        $currentNamespace = new NamespaceEntry($namespaceName, $this);
                        $this->addNamespace($currentNamespace);
                        $componentEntry->addNamespace($currentNamespace);
                    }
                } else if (($currentNamespace = $this->getNamespace($namespaceName)) === null) {
                    $currentNamespace = new NamespaceEntry($namespaceName, $this);
                    $this->addNamespace($currentNamespace);
                }
                continue;
            }

            if ($token[0] === \T_CLASS || $token[0] === \T_INTERFACE || $token[0] === \T_TRAIT) {
                $type = $token[0];
                for ($it->next(); $it->valid(); $it->next()) {
                    $token = $it->current();
                    if (!is_array($token) || $token[0] === \T_WHITESPACE) {
                        continue;
                    }
                    if ($token[0] !== \T_STRING) {
                        break;
                    }

                    $classEntry = new ClassEntry($token[1], $currentNamespace);
                    $classEntry->setType($type);
                    $currentNamespace->addClass($classEntry);
                    $this->addClass($classEntry);

                    $classEntry->parse();
                }
            }
        }

        return $this;
    }
}
