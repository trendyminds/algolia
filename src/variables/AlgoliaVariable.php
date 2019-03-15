<?php
/**
 * Algolia plugin for Craft CMS 3.x
 *
 * Easily pull search results from Algolia into your Craft CMS website
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\algolia\variables;

use trendyminds\algolia\Algolia;

use Craft;

/**
 * @author    TrendyMinds
 * @package   Algolia
 * @since     2.0.0
 */
class AlgoliaVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param null $optional
     * @return string
     */
    public function browse(string $index, $query = "", $browseParameters = [])
    {
        return Algolia::$plugin->algoliaService->browse($index, $query, $browseParameters);
    }

    public function search(string $index, $query = "", $searchParameters = [])
    {
        return Algolia::$plugin->algoliaService->search($index, $query, $searchParameters);
    }

    public function multipleQueries(array $queries = [])
    {
        return Algolia::$plugin->algoliaService->multipleQueries($queries);
    }
}
