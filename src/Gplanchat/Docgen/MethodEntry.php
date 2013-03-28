<?php

namespace Gplanchat\Docgen;

class MethodEntry
    extends AbstractCallableEntry
{
    public function parse(\ReflectionMethod $re)
    {
        foreach ($re->getParameters() as $parameter) {
            $parameterEntry = new ParameterEntry($parameter->getName(), $this);
            $parameterEntry->parse($parameter);
            $this->addParameter($parameterEntry);
        }

        if (($docComment = $re->getDocComment()) !== false) {
            $parser = new PhpDoc\Parser();
            $parser->parse($docComment);

            if (isset($parser['description'])) {
                $this->setDescription($parser['description']);
            }
        }

        return $this;
    }
}
