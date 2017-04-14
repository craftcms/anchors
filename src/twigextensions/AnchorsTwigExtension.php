<?php
namespace craft\anchors\twigextensions;


use craft\helpers\Template;
use craft\anchors\Plugin;
use Craft;
/**
 * Anchors Twig Extension
 */
class AnchorsTwigExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'anchors';
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            new \Twig_Filter('anchors', [$this, 'anchorsFilter']),
        );
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_Function('anchors', [$this, 'anchorsFilter']),
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
        $html = Plugin::getInstance()->anchors->parseHtml($html, $tags = 'h1,h2,h3');
        return Template::raw($html);


    }
}
