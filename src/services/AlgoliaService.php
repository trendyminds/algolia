<?php
/**
 * Algolia plugin for Craft CMS 4.x
 *
 * Easily pull search results from Algolia into your Craft CMS website
 *
 * @link      https://trendyminds.com
 *
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\algolia\services;

use Algolia\AlgoliaSearch\Api\SearchClient;
use craft\base\Component;
use craft\helpers\App;
use trendyminds\algolia\Algolia;

/**
 * @author    TrendyMinds
 *
 * @since     2.0.0
 */
class AlgoliaService extends Component
{
    private $client;

    // Public Methods
    // =========================================================================
    public function __construct()
    {
        $applicationId = App::parseEnv(Algolia::$plugin->getSettings()->applicationId);
        $apiKey = App::parseEnv(Algolia::$plugin->getSettings()->apiKey);

        $this->client = SearchClient::create($applicationId, $apiKey);
    }

    /**
     * Browse an index
     *
     * @param  mixed  $query
     * @return void
     */
    public function browse(string $index, $query = '', array $browseParameters = [])
    {
        $requestOptions = [
            'query' => $query,
        ];

        $requestOptions = array_merge($requestOptions, $browseParameters);

        $res = $this->client->browseObjects($index, $requestOptions);

        return $res;
    }

    /**
     * Search within an index
     *
     * @param  mixed  $query
     * @return void
     */
    public function search(string $index, $query = '', array $searchParameters = [])
    {
        $searchParameters = array_merge(['query' => $query], $searchParameters);

        $res = $this->client->searchSingleIndex($index, $searchParameters);

        return $res;
    }

    /**
     * Perform a multiple query search
     *
     * @return void
     */
    public function multipleQueries(array $queries = [])
    {
        $res = $this->client->search(['requests' => $queries]);

        return $res;
    }
}
