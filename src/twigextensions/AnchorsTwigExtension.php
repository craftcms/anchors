<?php
/**
 * Anchors plugin for Craft CMS 3.x
 *
 * Add linkable anchors to HTML headings in Craft.
 *
 * @link      https://www.mikestreety.co.uk
 * @copyright Copyright (c) 2017 Mike Street
 */

namespace mikestreety\anchors\twigextensions;

use mikestreety\anchors\Anchors;

use Craft;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Mike Street
 * @package   Anchors
 * @since     1.3.1
 */
class AnchorsTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Anchors';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('anchors', [$this, 'anchorsFilter']),
        ];
    }


    /**
     * Parses a string to automatically add anchors to all H1-H3’s
     *
     * @param string $html
     * @param mixed $tags
     * @return string
     */
    public function anchorsFilter($html, $tags = 'h1,h2,h3')
    {
        $html = craft()->anchors->parseHtml($html, $tags);
        return TemplateHelper::getRaw($html);
    }
}
