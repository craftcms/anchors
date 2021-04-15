<?php

namespace craft\anchors;

use Twig\TwigFilter;

/**
 * Anchors Twig Extension
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 2.0
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
            new TwigFilter('anchors', [$this, 'anchorsFilter'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Parses a string to automatically add anchors to all H1-H3’s
     *
     * @param string $html The HTML to parse.
     * @param string|string[] $tags The HTML tags to check for.
     * @param string|null The content language, used when converting non-ASCII characters to ASCII
     * @return string The parsed string.
     */
    public function anchorsFilter(string $html, $tags = 'h1,h2,h3', ?string $language = null): string
    {
        return Plugin::getInstance()->getParser()->parseHtml($html, $tags, $language);
    }
}
