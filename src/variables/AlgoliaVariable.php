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

    /**
     * Parses an array of key/value filters into a string for the Algolia filtering engine
     *
     * @param array $filters A key/value pair of filters
     *
     * @return string A stringified version of your filters for Algolia to use in the search query
     */
    public function parseFilters(array $filters = []): string
    {
        return collect($filters)
            ->filter(function ($item) {
                // Remove filters that are either "null" or empty
                return gettype($item) !== 'NULL' && $item !== '';
            })->map(function ($item, $group) {
                // Convert each group of results into string-based "OR" searches for Algolia's parsing engine
                return "($group:\"" . collect($item)->join("\" OR $group:\"") . "\")";
            })
            ->join(" AND "); // Combine all terms together
    }
}
