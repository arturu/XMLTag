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
    public function testRenderPhpunitTag()
    {
        $testElement = array(
            'type'=> 'phpunit',
            'attributes'=> array(
                "backupGlobals"=>"false",
                "backupStaticAttributes"=>"false",
                "bootstrap"=>"vendor/autoload.php",
                "colors"=>"true",
                "convertErrorsToExceptions"=>"true",
                "convertNoticesToExceptions"=>"true",
                "convertWarningsToExceptions"=>"true",
                "processIsolation"=>"false",
                "stopOnFailure"=>"false",
                "syntaxCheck"=>"false"
            ),
            "content" => "Tag content"
        );

        $actualOutput = Element::render($testElement);
        $this->assertTrue( is_string($actualOutput) );

        $expectedOutput = '<phpunit backupGlobals="false" backupStaticAttributes="false" bootstrap="vendor/autoload.php" colors="true" convertErrorsToExceptions="true" convertNoticesToExceptions="true" convertWarningsToExceptions="true" processIsolation="false" stopOnFailure="false" syntaxCheck="false">Tag content</phpunit>';
        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function testRenderHtmlTag()
    {
        $testElement = array(
            'type'=> 'div',
            'attributes'=> array(
                "id"=>"testId",
                "class" => "test class",
                "data-content" => "content data-test"
            ),
            'content' => "Test content",
        );

        $actualOutput = Element::render($testElement);
        $this->assertTrue( is_string($actualOutput) );

        $expectedOutput = '<div id="testId" class="test class" data-content="content data-test">Test content</div>';
        $this->assertEquals($expectedOutput,$actualOutput);

    }

    public function testRenderHtmlTagInjection()
    {
        $testElement = array(
            'type'=> 'section',
            'injectTag'=>'{{ content_attributes.addClass(content_classes) }}',
            'content' => "Test content",
        );

        $actualOutput = Element::render($testElement);
        $this->assertTrue( is_string($actualOutput) );

        $expectedOutput = '<section{{ content_attributes.addClass(content_classes) }}>Test content</section>';
        $this->assertEquals($expectedOutput,$actualOutput);

    }

    public function testRenderImplicitXmlDeclaration()
    {
        $testElement = array(
            'type' => '?xml',
            'attributes'=> array(
                "version"=>"1.0",
                "encoding"=>"UTF-8"),
            'implicit' => '?>'
        );

        $actualOutput = Element::render($testElement);
        $this->assertTrue( is_string($actualOutput) );

        $expectedOutput = '<?xml version="1.0" encoding="UTF-8"?>';
        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function testRenderImplicitDoctype()
    {
        $testElement = array(
            'injectTag' => '!DOCTYPE html',
            'implicit' => '>'
        );

        $actualOutput = Element::render($testElement);
        $this->assertTrue( is_string($actualOutput) );

        $expectedOutput = '<!DOCTYPE html>';
        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function testRenderImplicitImg()
    {
        $testElement = array(
            'type'=> 'img',
            'attributes'=> array(
                "src"=>"https://domain.tld/images.ext",
                "alt"=>"Alt text"),
            'implicit' => ' />'
        );

        $actualOutput = Element::render($testElement);
        $this->assertTrue( is_string($actualOutput) );

        $expectedOutput = '<img src="https://domain.tld/images.ext" alt="Alt text" />';
        $this->assertEquals($expectedOutput,$actualOutput);
    }
}
