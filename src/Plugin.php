<?php

namespace craft\anchors;

use Craft;

/**
 * Anchors plugin.
 * @method static Plugin getInstance()
 * @method Settings getSettings()
 *
 * @property Parser $parser
 * @property Settings $settings
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 2.0
 */
class Plugin extends \craft\base\Plugin
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!Craft::$app->getRequest()->getIsCpRequest()) {
            // Add in our Twig extension
            Craft::$app->getView()->registerTwigExtension(new TwigExtension());
        }

        $settings = $this->getSettings();
        $this->set('parser', [
            'class' => Parser::class,
            'anchorClass' => $settings->anchorClass,
            'anchorLinkClass' => $settings->anchorLinkClass,
            'anchorLinkText' => $settings->anchorLinkText,
            'anchorLinkTitleText' => $settings->anchorLinkTitleText,
        ]);
    }

    /**
     * @return Parser
     */
    public function getParser(): Parser
    {
        return $this->get('parser');
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }
}
