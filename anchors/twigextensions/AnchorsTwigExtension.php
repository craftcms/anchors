<?php
namespace Craft;

/**
 * Anchor Twig Extension
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
			'anchors' => new \Twig_Filter_Method($this, 'anchorsFilter'),
		);
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
		$tags = ArrayHelper::stringToArray($tags);

		$html = preg_replace_callback('/<('.implode('|', $tags).')([^>]*)>(.+?)<\/\1>/', function($matches)
		{
			// Remove HTML tags
			$heading = preg_replace('/<(.*?)>/', '', $matches[3]);

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

			// Put them together as the ID
			$id = implode('-', $words);

			return '<'.$matches[1].$matches[2].' id='.$id.'>' .
				$matches[3] .
				' <a class="anchor" href="#'.$id.'" title="'.Craft::t('Direct link to {heading}', array('heading' => $heading)).'">#</a>' .
				'</'.$matches[1].'>';
		}, $html);

		$charset = craft()->templates->getTwig()->getCharset();
		return new \Twig_Markup($html, $charset);
	}
}
