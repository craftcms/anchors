<?php
namespace craft\anchors\services;


use Craft;
use craft\anchors\Plugin;
use craft\base\Component;
use craft\helpers\ArrayHelper;



/**
 * Anchors Service
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 */
class Anchors extends Component
{
    // Properties
    // =========================================================================
    protected $anchorClass;

    /**
     * @var string|null The class name to give the anchor links
     */
    protected $anchorLinkClass;

    /**
     * @var string The visible text to give the anchor links
     */
    protected $anchorLinkText;

    /**
     * @var string The title/alt text to give the anchor links
     */
    protected $anchorLinkTitleText;


    // Public Methods
    // =========================================================================

    /**
     * Initializes the application component.
     *
     * @return void
     */
    public function init()
    {
        $this->anchorClass = \craft\anchors\Plugin::getInstance()->getSettings()->anchorClass;
        $this->anchorLinkClass = \craft\anchors\Plugin::getInstance()->getSettings()->anchorLinkClass;
        $this->anchorLinkText = \craft\anchors\Plugin::getInstance()->getSettings()->anchorLinkText;
        $this->anchorLinkTitleText = \craft\anchors\Plugin::getInstance()->getSettings()->anchorLinkTitleText;


    }

    /**
     * Parses some HTML for headings and adds anchor links to them.
     *
     * @param string       $html The HTML to parse
     * @param string|array $tags The tags to add anchor links to.
     *
     * @return string The parsed HTML.
     */
    public function parseHtml($html, $tags = 'h1,h2,h3')
    {
        $tags = ArrayHelper::toArray($tags);
        return preg_replace_callback('/<('.implode('|', $tags).')([^>]*)>(.+?)<\/\1>/', array($this, '_addAnchorToTagMatch'), $html);
    }

    /**
     * Generates an anchor name based on a given heading.
     *
     * @param string $heading
     *
     * @return string The generated anchor name.
     */
    public function generateAnchorName($heading)
    {
        // Remove HTML tags
        $heading = preg_replace('/<(.*?)>/', '', $heading);

        // Remove parentheses
        $heading = preg_replace('/\(.*?\)/', '', $heading);

        // Remove inner-word punctuation
        $heading = preg_replace('/[\'"‘’“”]/', '', $heading);

        // Convert non-breaking spaces to spaces
        $heading = str_replace(array('&nbsp;', ' '), ' ', $heading);

        // Get the "words". This will search for any unicode "letters" or "numbers"
        preg_match_all('/[\p{L}\p{N}]+/u', $heading, $words);
        $words = ArrayHelper::filterEmptyStringsFromArray($words[0]);

        // Turn them into camelCase
        foreach ($words as $i => $word)
        {
            // Special case if the whole word is capitalized
            if (strtoupper($word) == $word)
            {
                $words[$i] = strtolower($word);
            }
            else
            {
                $words[$i] = lcfirst($word);
            }
        }

        // Put them together as the anchor name
        return implode('-', $words);
    }

    // Private Methods
    // =========================================================================

    /**
     * Adds an anchor link to the given HTML tag match.
     *
     * @param array $match The
     *
     * @return string
     */
    private function _addAnchorToTagMatch($match)
    {
        $anchorName = $this->generateAnchorName($match[3]);
        $heading = str_replace(array('&nbsp;', ' '), ' ', $match[3]);

        return '<a'.($this->anchorClass ? ' class="'.$this->anchorClass.'"' : '').' name="'.$anchorName.'"></a>' .
            '<'.$match[1].$match[2].'>' .
            $match[3] .
            ' <a'.($this->anchorLinkClass ? ' class="'.$this->anchorLinkClass.'"' : '').' href="#'.$anchorName.'" title="'.Craft::t('anchors',$this->anchorLinkTitleText, array('heading' => $heading)).'">'.$this->anchorLinkText.'</a>' .
            '</'.$match[1].'>';
    }
}
