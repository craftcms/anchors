<?php

namespace craft\anchors;

use Craft;
use craft\anchors\services\Anchors;
use craft\anchors\twigextensions\AnchorsTwigExtension;



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

    protected function createSettingsModel()
    {
        return new \craft\anchors\Settings();
    }


    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Add in our Twig extensions
        Craft::$app->view->twig->addExtension(new AnchorsTwigExtension());

        $this->setComponents(array('anchors' => Anchors::class) );


    }


}