[![Packagist Version](https://img.shields.io/packagist/v/openpotato/gv100ad-php)](https://packagist.org/packages/openpotato/gv100ad-php)
![GitHub](https://img.shields.io/github/license/openpotato/gv100ad-php)

# gv100ad-php

A Python library for parsing GV100AD files (Gemeindeverzeichnis) provided by [Destatis](https://www.destatis.de/DE/Themen/Laender-Regionen/Regionales/Gemeindeverzeichnis/_inhalt.html). 

+ Supports PHP 8.2+
+ Supports all GV100AD record types:
  + Federal state (Bunduesland, Satzart 10)
  + Government region (Regierungsbezirk, Satzart 20)
  + Region (Region, Satzart 30)
  + District (Kreis, Satzart 40)
  + Municipality (Gemeinde, Satzart 50)
  + Municipal association (Gemeindeverbund, Satzart 60)

## Installation

**gv100ad-php** is available on [Packagist](https://packagist.org/), and installation via [Composer](https://getcomposer.org/) is the recommended way to install:

``` bash
composer require openpotato/gv100ad-php
```

## Getting started

Documentation is available in the [GitHub wiki](https://github.com/openpotato/gv100ad-php/wiki).

## Can I help?

Yes, that would be much appreciated. The best way to help is to post a response via the Issue Tracker and/or submit a Pull Request.
