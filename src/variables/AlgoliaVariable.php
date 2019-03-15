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
    public function browse(array $options = [])
    {
        $options = (object) $options;

        $index = $options->index;
        $query = $options->query ?? "";
        $browseParameters = $options->params ?? [];

        return Algolia::$plugin->algoliaService->browse($index, $query, $browseParameters);
    }

    public function search(array $options = [])
    {
        $options = (object) $options;

        $index = $options->index;
        $query = $options->query ?? "";
        $searchParameters = $options->params ?? [];

        return Algolia::$plugin->algoliaService->search($index, $query, $searchParameters);
    }

    public function multipleQueries(array $queries = [])
    {
        return Algolia::$plugin->algoliaService->multipleQueries($queries);
    }
}
