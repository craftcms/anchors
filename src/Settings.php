<?php

namespace craft\anchors;

use craft\base\Model;

/**
 * Anchors Settings Model
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 2.0
 */
class Settings extends Model
{
    /**
     * @var string|null $anchorClass The class name that should be given to named anchors.
     * (Default is null, meaning no class will be given.)
     */
    public $anchorClass;

    /**
     * @var string $anchorLinkClass The class name that should be given to anchor links.
     * (Default is 'anchor'.)
     */
    public $anchorLinkClass = 'anchor';

    /**
     * @var string $anchorLinkText The visible text that anchor links should have.
     * (Default is '#'.)
     */
    public $anchorLinkText = '#';

    /**
     * @var string $anchorLinkTitleText The title/alt text that anchor links should have.
     * If {heading} is included, it will be replaced with the heading text
     * the link is associated with. (Default is 'Direct link to {heading}'.)
     */
    public $anchorLinkTitleText = 'Direct link to {heading}';
}
