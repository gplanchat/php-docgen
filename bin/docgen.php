<?php

namespace
{
    use Gplanchat\Docgen;
    use Gplanchat\Docgen\Writer\Markdown;

    ini_set('display_errors', true);
    error_reporting(E_ALL);

    spl_autoload_register(function($className){
        $className = ltrim($className, '\\');
        $fileName  = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        require $fileName;
    });

    set_include_path(implode(PATH_SEPARATOR, [
        __DIR__ . '/../src/',
    ]));

    function printUsage()
    {
        echo "Usage : docgen <componentName> <outputPath> <inputPath1> [<inputPath2> [...]]";
    }

    /** @var int $argc */
    /** @var array $argv */
    if ($argc <= 3) {
        printUsage();
        die(0);
    }

    $componentName = $argv[1];
    if (!is_dir($argv[2])) {
        printUsage();
    }
    $basePath = $argv[2];

    $componentEntry = new Docgen\ComponentEntry($componentName);
    for ($i = 3; $i < $argc; $i++) {
        if (!is_dir($argv[$i])) {
            continue;
        }
        $componentEntry->parse($argv[$i]);
    }

    $writer = new Markdown\ComponentWriter();
    file_put_contents($basePath . 'README.md', $writer->export($componentEntry, 1, 4));

    $namespaceWriter = new Markdown\NamespaceWriter();
    foreach ($componentEntry->getNamespaces() as $namespaceEntry) {
        /** @var Docgen\NamespaceEntry $namespaceEntry */
        $filename = str_replace('\\', '-', $namespaceEntry->getName()) . '.md';
        file_put_contents($basePath . $filename, $namespaceWriter->export($namespaceEntry, 1, 4));
    }
}
