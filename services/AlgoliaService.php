<?php
/**
 * Algolia plugin for Craft CMS
 *
 * Algolia Service
 *
 * @author    TrendyMinds
 * @copyright Copyright (c) 2018 TrendyMinds
 * @link      https://trendyminds.com
 * @package   Algolia
 * @since     1.0.0
 */

namespace Craft;

use AlgoliaSearch\Client;

class AlgoliaService extends BaseApplicationComponent
{
    private $client;

    public function __construct()
    {
        $settings = craft()->plugins->getPlugin("algolia")->getSettings();

        $this->client = new Client($settings->applicationId, $settings->apiKey);
    }

    public function browse($index, $query = "", $attrs = [])
    {
        $res = $this->client->initIndex($index);
        $browse = $res->browse($query, $attrs);

        return $browse;
    }

    public function search($index, $query = "", $attrs = [])
    {
        $res = $this->client->initIndex($index);
        $search = $res->search($query, $attrs);

        return $search;
    }
}
