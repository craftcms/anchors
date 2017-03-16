<?php
/**
 * Anchors plugin for Craft CMS 3.x
 *
 * Add linkable anchors to HTML headings in Craft.
 *
 * @link      https://www.mikestreety.co.uk
 * @copyright Copyright (c) 2017 Mike Street
 */

/**
 * Anchors config.php
 *
 * Completely optional configuration settings for Anchors if you want to customize some
 * of its more esoteric behavior, or just want specific control over things.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'anchors.php' and make
 * your changes there.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as well, so you can
 * have different settings groups for each environment, just as you do for 'general.php'
 */

return [
	'anchorClass' => null,
	'anchorLinkClass' => 'anchor',
	'anchorLinkText' => '#',
	'anchorLinkTitleText' => 'Direct link to {heading}',
];
