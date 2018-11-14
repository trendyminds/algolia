<?php
/**
 * Algolia plugin for Craft CMS
 *
 * Algolia Variable
 *
 * @author    TrendyMinds
 * @copyright Copyright (c) 2018 TrendyMinds
 * @link      https://trendyminds.com
 * @package   Algolia
 * @since     1.0.0
 */

namespace Craft;

class AlgoliaVariable
{
    public function browse($index, $query = "", $attrs = [])
    {
        $data = craft()->algolia->browse($index, $query, $attrs);
        return $data;
    }

    public function search($index, $query = "", $attrs = [])
    {
        $data = craft()->algolia->search($index, $query, $attrs);
        $data = [$data];
        return $data;
    }
}
