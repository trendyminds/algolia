<?php
/**
 * Algolia plugin for Craft CMS 4.x
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
use craft\base\Model;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

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
	public string $schemaVersion = '2.0.0';

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
			CraftVariable::class,
			CraftVariable::EVENT_INIT,
			function (Event $event) {
				/** @var CraftVariable $variable */
				$variable = $event->sender;
				$variable->set('algolia', AlgoliaVariable::class);
			}
		);
	}

	// Protected Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	protected function createSettingsModel(): ?Model
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
