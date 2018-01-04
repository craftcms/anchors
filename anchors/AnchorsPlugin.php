<?php
namespace Craft;

/**
 * Anchors plugin class
 */
class AnchorsPlugin extends BasePlugin
{
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'Anchors';
	}

	/**
	 * @return string
	 */
	public function getVersion()
	{
		return '1.3.2';
	}

	/**
	 * @return string
	 */
	public function getSchemaVersion()
	{
		return '1.0.0';
	}

	/**
	 * @return string
	 */
	public function getDeveloper()
	{
		return 'Pixel & Tonic';
	}

	/**
	 * @return string
	 */
	public function getDeveloperUrl()
	{
		return 'http://pixelandtonic.com';
	}

	/**
	 * @return string
	 */
	public function getPluginUrl()
	{
		return 'https://github.com/craftcms/anchors';
	}

	/**
	 * @return string
	 */
	public function getDocumentationUrl()
	{
		return $this->getPluginUrl().'/blob/v1/README.md';
	}

	/**
	 * @return string
	 */
	public function getReleaseFeedUrl()
	{
		return 'https://raw.githubusercontent.com/craftcms/anchors/v1/releases.json';
	}

	/**
	 * @return AnchorsTwigExtension
	 */
	public function addTwigExtension()
	{
		Craft::import('plugins.anchors.twigextensions.AnchorsTwigExtension');
		return new AnchorsTwigExtension();
	}
}
