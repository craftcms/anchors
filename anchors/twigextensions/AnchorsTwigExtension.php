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
		$html = craft()->anchors->parseHtml($html, $tags);
		return TemplateHelper::getRaw($html);
	}
}
