<?php
/**
* Anchors plugin for Craft CMS 3.x
*
* Add linkable anchors to HTML headings in Craft.
*
* @link      https://www.mikestreety.co.uk
* @copyright Copyright (c) 2017 Mike Street
*/

namespace mikestreety\anchors\services;

use mikestreety\anchors\Anchors;

use Craft;
use craft\base\Component;

/**
* AnchorsService Service
*
* All of your plugin’s business logic should go in services, including saving data,
* retrieving data, etc. They provide APIs that your controllers, template variables,
* and other plugins can interact with.
*
* https://craftcms.com/docs/plugins/services
*
* @author    Mike Street
* @package   Anchors
* @since     0.1.0
*/
class AnchorsService extends Component
{
    // Properties
    // =========================================================================

    /**
    * @var string|null The class name to give the named anchors
    */
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
        $configService = Craft::$app->config;
        $this->anchorClass = $configService->get('anchorClass', 'anchors');
        $this->anchorLinkClass = $configService->get('anchorLinkClass', 'anchors');
        $this->anchorLinkText = $configService->get('anchorLinkText', 'anchors');
        $this->anchorLinkTitleText = $configService->get('anchorLinkTitleText', 'anchors');
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
        $tags = explode(',', $tags);
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
        $heading = str_replace(array('&nbsp;', ' '), ' ', $heading);

        // Get the "words". This will search for any unicode "letters" or "numbers"
        preg_match_all('/[\p{L}\p{N}]+/u', $heading, $words);
        $words = craft\helpers\ArrayHelper::filterEmptyStringsFromArray($words[0]);

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
        $heading = str_replace(array('&nbsp;', ' '), ' ', $match[3]);

        return '<a'.($this->anchorClass ? ' class="'.$this->anchorClass.'"' : '').' name="'.$anchorName.'"></a>' .
        '<'.$match[1].$match[2].'>' .
        $match[3] .
        ' <a'.($this->anchorLinkClass ? ' class="'.$this->anchorLinkClass.'"' : '').' href="#'.$anchorName.'" title="'.Craft::t('site', $this->anchorLinkTitleText, array('heading' => $heading)).'">'.$this->anchorLinkText.'</a>' .
        '</'.$match[1].'>';
    }
}
