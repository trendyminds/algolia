<?php
/**
 * Algolia plugin for Craft CMS 3.x
 *
 * Easily pull search results from Algolia into your Craft CMS website
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\algolia;

use trendyminds\algolia\services\AlgoliaService as AlgoliaServiceService;
use trendyminds\algolia\variables\AlgoliaVariable;
use trendyminds\algolia\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class Algolia
 *
 * @author    TrendyMinds
 * @package   Algolia
 * @since     2.0.0
 *
 * @property  AlgoliaServiceService $algoliaService
 */
class Algolia extends Plugin
{
	// Static Properties
	// =========================================================================

	/**
	 * @var Algolia
	 */
	public static $plugin;

	// Public Properties
	// =========================================================================

	/**
	 * @var string
	 */
	public $schemaVersion = '2.0.0';

	// Public Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		self::$plugin = $this;

		Event::on(
			UrlManager::class,
			UrlManager::EVENT_REGISTER_SITE_URL_RULES,
			function (RegisterUrlRulesEvent $event) {
				$event->rules['siteActionTrigger1'] = 'algolia/default';
			}
		);

		Event::on(
			UrlManager::class,
			UrlManager::EVENT_REGISTER_CP_URL_RULES,
			function (RegisterUrlRulesEvent $event) {
				$event->rules['cpActionTrigger1'] = 'algolia/default/do-something';
			}
		);

		Event::on(
			CraftVariable::class,
			CraftVariable::EVENT_INIT,
			function (Event $event) {
				/** @var CraftVariable $variable */
				$variable = $event->sender;
				$variable->set('algolia', AlgoliaVariable::class);
			}
		);

		Event::on(
			Plugins::class,
			Plugins::EVENT_AFTER_INSTALL_PLUGIN,
			function (PluginEvent $event) {
				if ($event->plugin === $this) {
				}
			}
		);

		Craft::info(
			Craft::t(
				'algolia',
				'{name} plugin loaded',
				['name' => $this->name]
			),
			__METHOD__
		);
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

	/**
	 * @inheritdoc
	 */
	protected function settingsHtml(): string
	{
		return Craft::$app->view->renderTemplate(
			'algolia/settings',
			[
				'settings' => $this->getSettings()
			]
		);
	}
}
