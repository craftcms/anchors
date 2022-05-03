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
    /**
     * @inheritdoc
     */
    public static function config(): array
    {
        return [
            'components' => [
                'parser' => [
                    'class' => Parser::class,
                ],
            ],
        ];
    }

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
        $parser = $this->getParser();
        $parser->anchorClass = $parser->anchorClass ?? $settings->anchorClass;
        $parser->anchorLinkPosition = $parser->anchorLinkPosition ?? $settings->anchorLinkPosition;
        $parser->anchorLinkClass = $parser->anchorLinkClass ?? $settings->anchorLinkClass;
        $parser->anchorLinkText = $parser->anchorLinkText ?? $settings->anchorLinkText;
        $parser->anchorLinkTitleText = $parser->anchorLinkTitleText ?? $settings->anchorLinkTitleText;
    }

    /**
     * @return Parser
     */
    public function getParser(): Parser
    {
        return $this->get('parser');
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?\craft\base\Model
    {
        return new Settings();
    }
}
