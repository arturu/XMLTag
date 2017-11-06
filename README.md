# XMLTag
[![Build Status](https://travis-ci.org/arturu/XMLTag.svg?branch=master)](https://travis-ci.org/arturu/XMLTag)

Convert PHP array to XML tag

## Installation

```
composer require arturu/xml-tag
```

## Usage example
```
<?php
use Arturu\XMLTag\Element;

$tag = array(
    'type'=> 'div', // optional
    'attributes'=> array("id"=>"testId","class"=>"a b c",foo"=>"bar"), // optional
    'injectTag' => false // optional, inject raw text in to tag
    'implicit'=> false, // optional, closure implicit set text ' />'
    'content' => "Test content", // optional
);
echo Element::render($tag);
```
Output
```
<div id="testId" class="a b c" foo="bar">Test content</div>
```
For more examples see: tests/ElementTest.php

## License
GPL v3.0 - Read LICENSE file