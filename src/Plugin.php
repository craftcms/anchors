<?php

namespace craft\anchors;

use Craft;
use craft\anchors\models\Settings;
use craft\anchors\services\Anchors;
use craft\anchors\twigextensions\Extension;

/**
 * Anchors plugin.
 *
 * @method static getInstance()
 * @property Anchors $anchors
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  2.0
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

        // Add in our Twig extension
        Craft::$app->getView()->getTwig()->addExtension(new Extension());

        $this->setComponents(['anchors' => Anchors::class]);
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
