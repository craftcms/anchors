<?php
namespace Craft;

/**
 * Anchors plugin class
 */
class AnchorsPlugin extends BasePlugin
{
	public function getName()
	{
	    return 'Anchors';
	}

	public function getVersion()
	{
	    return '1.0';
	}

	public function getDeveloper()
	{
	    return 'Pixel & Tonic';
	}

	public function getDeveloperUrl()
	{
	    return 'http://pixelandtonic.com';
	}

	public function addTwigExtension()
	{
		Craft::import('plugins.anchors.twigextensions.AnchorsTwigExtension');
		return new AnchorsTwigExtension();
	}
}
