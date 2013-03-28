php-docgen
==========

A PHPDoc to Markdown documentation generator

## Documentation

Docgen generates its own documentation : [Read the docs](docs/README.md)

## Installation

```
$ git clone https://github.com/gplanchat/php-docgen.git /opt/php-docgen
$ ln -s /opt/php-docgen/bin/docgen /usr/local/bin
```

## Usage

```docgen <componentName> <outputPath> <inputPath1> [<inputPath2> [...]]```

For example, to generate `php-docgen`'s documentation, I use :

```$ docgen Gpanchat\\Docgen ../docs/ Gplanchat/Docgen/```


