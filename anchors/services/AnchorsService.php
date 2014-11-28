<?php
namespace Craft;

/**
 * Anchors Service
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 */
class AnchorsService extends BaseApplicationComponent
{
	// Public Methods
	// =========================================================================

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
		$tags = ArrayHelper::stringToArray($tags);
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

		return '<'.$match[1].$match[2].' id='.$anchorName.'>' .
			$match[3] .
			' <a class="anchor" href="#'.$anchorName.'" title="'.Craft::t('Direct link to {heading}', array('heading' => $match[3])).'">#</a>' .
			'</'.$match[1].'>';
	}
}
