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

/**
 * Class Element
 * @package Arturu\XMLTag
 */
class Element
{
    /**
     * @param array $element
     *  array(
     *    'type'=> 'tag',
     *    'attributes'=> array, // see self::attributes
     *    'injectTag' => 'Raw text' // inject raw text in to tag
     *    'implicit'=> bool|'>', // true for implicit or text '>'
     *    'content' => string, // tag content
     *  )
     * @return string
     */
    public static function render(array $element)
    {
        $elementType = (isset($element['type'])) ? $element['type'] : '';

        // open element
        $output = '<'.$elementType;

        // setting attributes
        if ( isset($element['attributes']) ) {
            $output .= ' ' . self::attributes($element['attributes']);
        }

        // inject raw text
        if ( isset($element['injectTag']) && $element['injectTag'] ) {
            $output .= $element['injectTag'];
        }

        // if implicit
        if ( isset($element['implicit']) &&  $element['implicit'] ) {
            // out: <tag attr="value" ... />
            return $output . $element['implicit'];
        }
        // or not implicit
        else {
            $output .= '>';
        }

        // put the content into element
        if ( isset($element['content']) && $element['content'] ) {
            $output .= $element['content'];
        }

        // close element
        $output .= '</'.$elementType.'>';

        // out: <tag attr="value" ...>...</tag>
        return trim($output);
    }

    /**
     * @param array $attributes
     *   array(
     *     'key'=>'value',
     *     'key'=> array("value","value","value",...),
     *     ...
     *   )
     * @return string
     */
    public static function attributes(array $attributes)
    {
        $output = '';

        foreach ($attributes as $key => $values){
            $output .= ' ' . self::attribute($key, $values);
        }

        // out: attr1="value" attr2="value value" attr3="val val" etc...
        return trim($output);
    }


    /**
     * @param string $key
     * @param $values
     * @return string
     */
    public static function attribute($key, $values)
    {
        $output = '';

        if (is_array($values)) {
            //out: key="value value value value"
            $output .= $key . '="' . self::values($values) . '"';
        }
        else {
            //out: key="value"
            $output .= $key . '="' . self::value($values) . '"';
        }

        return trim($output);
    }

    /**
     * @param array $values
     * @return string
     */
    public static function values(array $values)
    {
        $output = '';

        foreach ($values as $value) {
            $output .= ' ' . self::value($value);
        }

        // out: value value value
        return trim($output);
    }

    /**
     * @param string $value
     * @return string
     */
    public static function value($value)
    {
        //out: value
        return trim($value);
    }
}