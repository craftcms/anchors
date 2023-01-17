<?php

namespace craft\anchors;

use Craft;
use craft\base\Component;
use craft\helpers\ArrayHelper;
use craft\helpers\Html;
use craft\helpers\StringHelper;

/**
 * Class Parser
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 2.0
 */
class Parser extends Component
{
    // Properties
    // =========================================================================

    /**
     * @var string|null
     */
    public $anchorClass;

    /**
     * @var string|null Where the anchor link should be positioned within the heading, relative to the heading text (`before` or `after`)
     * @since 2.3.0
     */
    public $anchorLinkPosition;

    /**
     * @var string|null
     */
    public $anchorLinkClass;

    /**
     * @var string|null
     */
    public $anchorLinkText;

    /**
     * @var string|null
     */
    public $anchorLinkTitleText;

    /**
     * @var bool|null
     * @since 3.3.0
     */
    public $useAdditionalTagToAnchorTo;

    // Public Methods
    // =========================================================================

    /**
     * Parses some HTML for headings and adds anchor links to them.
     *
     * @param string $html The HTML to parse
     * @param string|string[] $tags The tags to add anchor links to.
     * @param string|null $language The content language, used when converting non-ASCII characters to ASCII
     * @return string The parsed HTML.
     */
    public function parseHtml(string $html, $tags = 'h1,h2,h3', ?string $language = null): string
    {
        if (is_string($tags)) {
            $tags = StringHelper::split($tags);
        }

        return preg_replace_callback('/<(' . implode('|', $tags) . ')([^>]*)>\s*([\w\W]+?)\s*<\/\1>/', function(array $match) use ($language) {
            $headingHasId = false;
            // try to get id from the heading tag only if we're not supposed to use additional tag to anchor to
            if (!$this->useAdditionalTagToAnchorTo && !empty($match[2])) {
                $anchorName = $this->getIdFromHeading($match[2]);
                if (!empty($anchorName)) {
                    $headingHasId = true;
                }
            }
            // if we still don't have the name for the anchor - generate it
            if (empty($anchorName)) {
                $anchorName = $this->generateAnchorName($match[3], $language);
            }
            $heading = preg_replace('/\s+/', ' ', strip_tags(str_replace(['&nbsp;', ' '], ' ', $match[3])));
            $link = Html::tag('a', $this->anchorLinkText, [
                'class' => $this->anchorLinkClass,
                'title' => Craft::t('anchors', $this->anchorLinkTitleText, ['heading' => $heading]),
                'aria-label' => Craft::t('anchors', $this->anchorLinkTitleText, ['heading' => $heading]),
                'href' => "#$anchorName",
            ]);

            return
                ($this->useAdditionalTagToAnchorTo ?
                    Html::tag('span', '', [
                        'class' => $this->anchorClass,
                        'id' => $anchorName,
                    ]) : '') .
                "<$match[1]$match[2]" . (!$this->useAdditionalTagToAnchorTo && !$headingHasId ? " id=\"$anchorName\"" : "") . ">" .
                ($this->anchorLinkPosition === Settings::POS_BEFORE ? "$link $match[3]" : "$match[3] $link") .
                "</$match[1]>";
        }, $html);
    }

    /**
     * Generates an anchor name based on a given heading.
     *
     * @param string $heading
     * @param string|null $language
     * @return string The generated anchor name.
     */
    public function generateAnchorName(string $heading, string $language = null): string
    {
        // Remove HTML tags
        $heading = preg_replace('/<(.*?)>/', '', $heading);

        // Remove parentheses
        $heading = preg_replace('/\(.*?\)/', '', $heading);

        // Remove inner-word punctuation
        $heading = preg_replace('/[\'"‘’“”]/u', '', $heading);

        // Convert non-breaking spaces to spaces
        $heading = str_replace(['&nbsp;', ' '], ' ', $heading);

        // Get the "words". This will search for any unicode "letters" or "numbers"
        preg_match_all('/[\p{L}\p{N}]+/u', $heading, $words);
        $words = ArrayHelper::filterEmptyStringsFromArray($words[0]);

        // Turn them into camelCase
        foreach ($words as $i => $word) {
            // Special case if the whole word is capitalized
            if (strtoupper($word) === $word) {
                $words[$i] = strtolower($word);
            } else {
                $words[$i] = lcfirst($word);
            }
        }

        // Put them together as the anchor name
        return StringHelper::toAscii(implode('-', $words), $language);
    }

    /**
     * Check if there's an id in the attributes. If there is one - return its value.
     *
     * @param $attributes
     * @return string|null
     */
    public function getIdFromHeading($attributes): ?string
    {
        $id = null;
        preg_match('/id="(\w+)"/', $attributes, $match);

        if (isset($match[1]) && !empty($match[1])) {
            $id = trim($match[1]);
        }

        return $id;
    }
}
