<?php
/**
 * This file is part of the arturu/XMLTag package.
 *
 * (c) Pietro Arturo Panetta <arturu@arturu.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arturu\XMLTag;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase
{
    public function testElement()
    {
        $testElement = array(
            'type'=> 'div',
            'attributes'=> array("id"=>"testId"),
            'implicit'=> false, // true for implicit
            'content' => "Test content", // tag content
        );
        $this->assertTrue( is_string(Element::render($testElement)) );
    }
}
