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
    /** @since 2.3.0 */
    public const POS_BEFORE = 'before';
    /** @since 2.3.0 */
    public const POS_AFTER = 'after';

    /**
     * @var string|null The class name that should be given to named anchors.
     * (Default is null, meaning no class will be given.)
     */
    public $anchorClass;

    /**
     * @var string Where the anchor link should be positioned within the heading, relative to the heading text (`before` or `after`)
     * @since 2.3.0
     */
    public $anchorLinkPosition = self::POS_AFTER;

    /**
     * @var string The class name that should be given to anchor links.
     * (Default is 'anchor'.)
     */
    public $anchorLinkClass = 'anchor';

    /**
     * @var string The visible text that anchor links should have.
     * (Default is '#'.)
     */
    public $anchorLinkText = '#';

    /**
     * @var string The title/alt text that anchor links should have.
     * If {heading} is included, it will be replaced with the heading text
     * the link is associated with. (Default is 'Direct link to {heading}'.)
     */
    public $anchorLinkTitleText = 'Direct link to {heading}';

    /**
     * @var bool Whether to render an additional tag above the heading
     * and use it to scroll to when the anchor link is clicked.
     * If set to 'false', anchor id is added to the heading itself.
     * (Default is 'true'.)
     * @since 3.3.0
     */
    public $useAdditionalTagToAnchorTo = true;
}
