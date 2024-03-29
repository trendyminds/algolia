<?php
/**
 * Algolia plugin for Craft CMS 4.x
 *
 * Easily pull search results from Algolia into your Craft CMS website
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\algolia\services;

use trendyminds\algolia\Algolia;
use Algolia\AlgoliaSearch\SearchClient;

use Craft;
use craft\base\Component;
use craft\helpers\App;

/**
 * @author    TrendyMinds
 * @package   Algolia
 * @since     2.0.0
 */
class AlgoliaService extends Component
{
	private $client;

	// Public Methods
	// =========================================================================
	function __construct()
	{
		$applicationId = App::parseEnv(Algolia::$plugin->getSettings()->applicationId);
		$apiKey = App::parseEnv(Algolia::$plugin->getSettings()->apiKey);

		$this->client = SearchClient::create($applicationId, $apiKey);
	}

	/**
	 * Browse an index
	 *
	 * @param string $index
	 * @param mixed $query
	 * @param array $browseParameters
	 * @return void
	 */
	public function browse(string $index, $query = "", array $browseParameters = [])
	{
		$index = $this->client->initIndex($index);

		$requestOptions = [
			"query" => $query
		];

		$requestOptions = array_merge($requestOptions, $browseParameters);

		$res = $index->browseObjects($requestOptions);

		return $res;
	}

	/**
	 * Search within an index
	 *
	 * @param string $index
	 * @param mixed $query
	 * @param array $searchParameters
	 * @return void
	 */
	public function search(string $index, $query = "", array $searchParameters = [])
	{
		$index = $this->client->initIndex($index);

		$res = $index->search($query, $searchParameters);

		return $res;
	}

	/**
	 * Perform a multiple query search
	 *
	 * @param array $queries
	 * @return void
	 */
	public function multipleQueries(array $queries = [])
	{
		$res = $this->client->multipleQueries($queries);

		return $res;
	}
}
