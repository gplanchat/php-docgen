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
        echo <<<USAGE_EOF
Usage :
docgen component [<options>] <componentName> <outputPath> <inputPath1> [<inputPath2> [...]]
docgen extension <extensionName> <outputPath>
USAGE_EOF;

    }

    $footer = "\n\n[These docs are proudly built by Docgen](https://github.com/gplanchat/php-docgen)";

    /** @var int $argc */
    /** @var array $argv */

    $i = 1;
    $mode = $argv[$i++];
    switch ($mode) {
    case 'component':
        $options = [];
        for (; $i < $argc; $i++) {
            if (strpos($argv[$i], '--') === false) {
                break;
            }
            if (($position = strpos($argv[$i], '=')) !== false) {
                $optionName = substr($argv[$i], 2, $position - 2);
                $optionValue = substr($argv[$i], $position + 1);
            } else if (isset($argv[$i + 1])) {
                $optionName = substr($argv[$i], 2);
                $optionValue = $argv[++$i];
            } else {
                printUsage();
                die(0);
            }

            $options[$optionName] = $optionValue;
        }
        unset($optionName, $optionValue);

        if ($argc <= $i + 2) {
            printUsage();
            die(0);
        }

        $componentName = $argv[$i++];
        if (!is_dir($argv[$i])) {
            printUsage();
        }
        $basePath = $argv[$i++];

        if (isset($options['autoloader'])) {
            if (!is_file($options['autoloader'])) {
                die(sprintf('File %s does not exist.', $options['autoloader']));
            }

            require $options['autoloader'];
        }

        $paths = [];
        for (; $i < $argc; $i++) {
            if (!is_dir($argv[$i])) {
                continue;
            }
            $paths[] = $argv[$i];
        }

        set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $paths));

        $componentEntry = new Docgen\ComponentEntry($componentName);
        foreach ($paths as $path) {
            $componentEntry->parse($path);
        }

        $writer = new Markdown\ComponentWriter();
        file_put_contents($basePath . 'README.md', $writer->export($componentEntry, 1, 4) . $footer);

        $namespaceWriter = new Markdown\NamespaceWriter();
        foreach ($componentEntry->getNamespaces() as $namespaceEntry) {
            /** @var Docgen\NamespaceEntry $namespaceEntry */
            $filename = str_replace('\\', '-', $namespaceEntry->getName()) . '.md';
            file_put_contents($basePath . $filename, $namespaceWriter->export($namespaceEntry, 1, 4) . $footer);
        }
        break;

    case 'extension':
        if ($argc <= 3) {
            printUsage();
            die(0);
        }

        $extensionName = $argv[$i++];
        $basePath = $argv[$i++];

        $extensionEntry = new Docgen\ExtensionEntry($extensionName);
        for (; $i < $argc; $i++) {
            if (!is_dir($argv[$i])) {
                continue;
            }
            $extensionEntry->parse($argv[$i]);
        }

        $writer = new Markdown\ComponentWriter();
        file_put_contents($basePath . 'README.md', $writer->export($extensionEntry, 1, 4) . $footer);

        $namespaceWriter = new Markdown\NamespaceWriter();
        foreach ($extensionEntry->getNamespaces() as $namespaceEntry) {
            /** @var Docgen\NamespaceEntry $namespaceEntry */
            $filename = str_replace('\\', '-', $namespaceEntry->getName()) . '.md';
            file_put_contents($basePath . $filename, $namespaceWriter->export($namespaceEntry, 1, 4) . $footer);
        }
        break;
    }
}
