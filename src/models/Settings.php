<?php
/**
 * Algolia plugin for Craft CMS 4.x
 *
 * Easily pull search results from Algolia into your Craft CMS website
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\algolia\models;

use trendyminds\algolia\Algolia;

use Craft;
use craft\base\Model;

/**
 * @author    TrendyMinds
 * @package   Algolia
 * @since     2.0.0
 */
class Settings extends Model
{
	// Public Properties
	// =========================================================================

	/**
	 * @var string
	 */
	public string $applicationId = '';
	public string $apiKey = '';

	// Public Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	public function rules(): array
	{
		return [
			['applicationId', 'string'],
			['applicationId', 'default', 'value' => ''],

			['apiKey', 'string'],
			['apiKey', 'default', 'value' => ''],
		];
	}
}
