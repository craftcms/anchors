<?php
namespace craft\anchors;

use craft\helpers\Template;

/**
 * Anchors Twig Extension
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  2.0
 */
class TwigExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName(): string
    {
        return 'anchors';
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters(): array
    {
        return [
            new \Twig_Filter('anchors', [$this, 'anchorsFilter']),
        ];
    }

    /**
     * Parses a string to automatically add anchors to all H1-H3’s
     *
     * @param string $html The HTML to parse.
     * @param mixed  $tags  The HTML tags to check for.
     *
     * @return \Twig_Markup The parsed string.
     */
    public function anchorsFilter($html, $tags = 'h1,h2,h3'): \Twig_Markup
    {
        $html = Plugin::getInstance()->getParser()->parseHtml($html, $tags);
        return Template::raw($html);
    }
}
