# XMLTag
Convert PHP array to XML tag

## Installation

```
composer require arturu/XMLTag --dev
```

## Usage

```
<?php
use Arturu\XMLTag;

$tag = array(
    'type'=> 'div',
    'attributes'=> array("id"=>"testId","class"=>"a b c",foo"=>"bar"),
    'implicit'=> false, // true for implicit
    'content' => "Test content", // tag content
);
echo Element::render($tag);
```
### Output
```
<div id="testId" class="a b c" foo="bar">Test content</div>
```

## License
GPL v3.0 - Read LICENSE file