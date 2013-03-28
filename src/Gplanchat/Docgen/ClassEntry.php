<?php

namespace Gplanchat\Docgen;

class ClassEntry
    implements EntryInterface
{
    use EntryTrait;
    use ConstantAwareTrait;
    use ParameterAwareTrait;
    use MethodAwareTrait;

    /**
     * @var string|null
     */
    private $parentClass = null;
    private $parentInterfaces = [];
    private $usedTraits = [];
    private $type = T_CLASS;

    public function setType($type)
    {
        if (in_array($type, [T_CLASS, T_TRAIT, T_INTERFACE])) {
            $this->type = $type;
        }

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $parentClass
     * @return $this
     */
    public function setParentClass($parentClass)
    {
        $this->parentClass = $parentClass;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getParentClass()
    {
        return $this->parentClass;
    }

    /**
     * @param array $parentInterfaces
     * @return $this
     */
    public function setParentInterfaces(array $parentInterfaces)
    {
        $this->parentInterfaces = $parentInterfaces;

        return $this;
    }

    /**
     * @param string $parentInterface
     * @return $this
     */
    public function addParentInterface($parentInterface)
    {
        $this->parentInterfaces[] = $parentInterface;

        return $this;
    }

    /**
     * @return array
     */
    public function getParentInterfaces()
    {
        return $this->parentInterfaces;
    }

    /**
     * @param array $usedTraits
     * @return $this
     */
    public function setUsedTraits(array $usedTraits)
    {
        $this->usedTraits = $usedTraits;

        return $this;
    }

    /**
     * @param $usedTrait
     * @return $this
     */
    public function addUsedTrait($usedTrait)
    {
        $this->usedTraits[] = $usedTrait;

        return $this;
    }

    /**
     * @return array
     */
    public function getUsedTraits()
    {
        return $this->usedTraits;
    }

    /**
     *
     */
    public function parse(\ReflectionClass $re = null)
    {
        if ($re === null) {
            $fqn = $this->getName();

            if (($namespaceEntry = $this->getParentEntry()) !== null) {
                $namespace = $namespaceEntry->getName();

                $fqn = $namespace . '\\' . $this->getName();
            }

            $re = new \ReflectionClass($fqn);
        }

        if (($parentClass = $re->getParentClass()) !== false) {
            $this->setParentClass($parentClass->getName());
        }

        foreach ($re->getInterfaceNames() as $interfaceName) {
            $this->addParentInterface($interfaceName);
        }

        foreach ($re->getTraitNames() as $traitName) {
            $this->addUsedTrait($traitName);
        }

        foreach ($re->getConstants() as $constantName => $constantValue) {
            $constantEntry = new ConstantEntry($constantName, $this);
            $constantEntry->setValue($constantValue);
            $this->addConstant($constantEntry);
        }

        foreach ($re->getMethods() as $method) {
            if ($method->getDeclaringClass() != $re) {
                continue;
            }

            $methodEntry = new MethodEntry($method->getName(), $this);
            $methodEntry->parse($method);
            $this->addMethod($methodEntry);
        }

        if (($docComment = $re->getDocComment()) !== false) {
            $parser = new PhpDoc\Parser();
            $parser->parse($docComment);

            if (isset($parser['description'])) {
                $this->setDescription($parser['description']);
            }

            if (isset($parser['method']) && is_array($parser['method'])) {
                foreach ($parser['method'] as $methodDeclaration) {
                    $this->addMethod($this->parseMethodDeclaration($methodDeclaration));
                }
            }
        }
    }

    public function parseMethodDeclaration($methodDeclaration)
    {
        $it = new \ArrayIterator(token_get_all('<?php ' . $methodDeclaration));
        $it->rewind();

        for (; $it->valid(); $it->next()) {
            $token = $it->current();
            if (is_array($token) && $token[0] == \T_OPEN_TAG) {
                break;
            }
        }

        $type = null;
        $name = null;
        $buffer = '';
        for ($it->next(); $it->valid(); $it->next()) {
            $token = $it->current();
            if (is_array($token) && $token[0] == \T_WHITESPACE) {
                $type = $buffer;
                $buffer = '';
                continue;
            }
            if ($token == '(') {
                $name = $buffer;
                $buffer = '';
                break;
            }

            if (is_array($token)) {
                $buffer .= $token[1];
            } else {
                $buffer .= $token;
            }
        }

        $methodEntry = new MethodEntry($name, $this);
        $methodEntry->setReturnType($type);

        $type = null;
        $name = null;
        $defaultValue = null;
        $buffer = '';
        for ($it->next(); $it->valid(); $it->next()) {
            $token = $it->current();
            if (!empty($buffer) && ((is_array($token) && $token[0] == \T_WHITESPACE) || $token == ')' || $token == '=')) {
                if ($buffer[0] !== '$') {
                    if ($type === null) {
                        $type = $buffer;
                        $buffer = '';
                    } else {
                        $defaultValue = $buffer;
                        $buffer = '';
                    }
                } else {
                    $name = $buffer;
                    $buffer = '';
                }

                if ($token == ')') {
                    break;
                }
                continue;
            }

            if ($token == ',') {
                $parameterEntry = new ParameterEntry($name, $methodEntry);
                $methodEntry->addParameter($parameterEntry);
                if ($type !== null) {
                    $parameterEntry->setType($type);
                }
                if ($defaultValue !== null) {
                    $parameterEntry->setDefaultValue($defaultValue);
                    if ($defaultValue === 'null') {
                        $parameterEntry->setIsNullable(true);
                    }
                }

                $name = null;
                $type = null;
                $defaultValue = null;
                $buffer = '';
                continue;
            }

            if (is_array($token)) {
                $buffer .= $token[1];
            } else {
                $buffer .= $token;
            }
        }

        return $methodEntry;
    }
}
