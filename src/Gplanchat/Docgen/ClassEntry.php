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
 * Class entry manager. Handles every class's element delcaration.
 *
 * @package Gplanchat\Docgen
 */
class ClassEntry
    implements EntryInterface
{
    use EntryTrait;
    use ConstantAwareTrait;
    use ParameterAwareTrait;
    use MethodAwareTrait;

    /**
     * Parent class name
     *
     * @var string|null
     */
    private $parentClass = null;

    /**
     * Parent interfaces names list
     *
     * @var array
     */
    private $parentInterfaces = [];

    /**
     * Used traits names list
     *
     * @var array
     */
    private $usedTraits = [];

    /**
     * Class entry type, is either *\T_CLASS*, *\T_TRAIT* or *\T_INTERFACE*.
     *
     * @var int
     */
    private $type = \T_CLASS;

    /**
     * Define the class entry type
     *
     * @param int $type
     * @return $this
     */
    public function setType($type)
    {
        if (in_array($type, [\T_CLASS, \T_TRAIT, \T_INTERFACE])) {
            $this->type = $type;
        }

        return $this;
    }

    /**
     * Get the class entry type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Define the parent class' name
     *
     * @param string $parentClass
     * @return $this
     */
    public function setParentClass($parentClass)
    {
        $this->parentClass = $parentClass;

        return $this;
    }

    /**
     * Get the parent class' name
     *
     * @return string|null
     */
    public function getParentClass()
    {
        return $this->parentClass;
    }

    /**
     * Define the parent interfaces names list
     *
     * @param array $parentInterfaces
     * @return $this
     */
    public function setParentInterfaces(array $parentInterfaces)
    {
        $this->parentInterfaces = $parentInterfaces;

        return $this;
    }

    /**
     * Add a parent interface name to the list
     *
     * @param string $parentInterface
     * @return $this
     */
    public function addParentInterface($parentInterface)
    {
        $this->parentInterfaces[] = $parentInterface;

        return $this;
    }

    /**
     * Get the parent interfaces names list
     *
     * @return array
     */
    public function getParentInterfaces()
    {
        return $this->parentInterfaces;
    }

    /**
     * Define the used traits names list
     *
     * @param array $usedTraits
     * @return $this
     */
    public function setUsedTraits(array $usedTraits)
    {
        $this->usedTraits = $usedTraits;

        return $this;
    }

    /**
     * Add an used trait name to the list
     *
     * @param $usedTrait
     * @return $this
     */
    public function addUsedTrait($usedTrait)
    {
        $this->usedTraits[] = $usedTrait;

        return $this;
    }

    /**
     * Get the used traits names list
     *
     * @return array
     */
    public function getUsedTraits()
    {
        return $this->usedTraits;
    }

    /**
     * Parse class's definition by reflection
     *
     * @param \ReflectionClass $re
     * @return $this
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
            $parser = new DocBlock\Parser();
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

        return $this;
    }

    /**
     * Parse DocBlock method declaration (for virtual methods using __call() magic)
     *
     * @param string $methodDeclaration
     * @return MethodEntry
     */
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
