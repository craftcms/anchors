<?php
/**
 * Anchors plugin for Craft CMS 3.x
 *
 * Add linkable anchors to HTML headings in Craft.
 *
 * @link      https://www.mikestreety.co.uk
 * @copyright Copyright (c) 2017 Mike Street
 */

namespace mikestreety\anchors;

use mikestreety\anchors\services\AnchorsService as AnchorsServiceService;
use mikestreety\anchors\twigextensions\AnchorsTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Craft plugins are very much like little applications in and of themselves. We’ve made
 * it as simple as we can, but the training wheels are off. A little prior knowledge is
 * going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL,
 * as well as some semi-advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://craftcms.com/docs/plugins/introduction
 *
 * @author    Mike Street
 * @package   Anchors
 * @since     1.3.1
 *
 * @property  AnchorsServiceService $anchorsService
 */
class Anchors extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * Anchors::$plugin
     *
     * @var Anchors
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * Anchors::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Add in our Twig extensions
        Craft::$app->view->twig->addExtension(new AnchorsTwigExtension());

/**
 * Logging in Craft involves using one of the following methods:
 *
 * Craft::trace(): record a message to trace how a piece of code runs. This is mainly for development use.
 * Craft::info(): record a message that conveys some useful information.
 * Craft::warning(): record a warning message that indicates something unexpected has happened.
 * Craft::error(): record a fatal error that should be investigated as soon as possible.
 *
 * Unless `devMode` is on, only Craft::warning() & Craft::error() will log to `craft/storage/logs/web.log`
 *
 * It's recommended that you pass in the magic constant `__METHOD__` as the second parameter, which sets
 * the category to the method (prefixed with the fully qualified class name) where the constant appears.
 *
 * To enable the Yii debug toolbar, go to your user account in the AdminCP and check the
 * [] Show the debug toolbar on the front end & [] Show the debug toolbar on the Control Panel
 *
 * http://www.yiiframework.com/doc-2.0/guide-runtime-logging.html
 */
        Craft::info('Anchors ' . Craft::t('anchors', 'plugin loaded'), __METHOD__);
    }

    // Protected Methods
    // =========================================================================

}
