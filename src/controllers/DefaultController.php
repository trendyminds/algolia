<?php
/**
 * Algolia plugin for Craft CMS 3.x
 *
 * Easily pull search results from Algolia into your Craft CMS website
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\algolia\controllers;

use trendyminds\algolia\Algolia;

use Craft;
use craft\web\Controller;
use craft\helpers\Json;

/**
 * @author    TrendyMinds
 * @package   Algolia
 * @since     2.0.0
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['search', 'browse', 'multiple-queries'];

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionSearch()
    {
        $this->requirePostRequest();

        $postData = Json::decode(Craft::$app->getRequest()->getRawBody(), true);

        $index = $postData["index"];
        $query = $postData["query"] ?? "";
        $searchParameters = $postData["params"] ?? [];

        $data = Algolia::$plugin->algoliaService->search($index, $query, $searchParameters);

        return $this->asJson($data);
    }

    /**
     * @return mixed
     */
    public function actionMultipleQueries()
    {
        $this->requirePostRequest();

        $postData = Json::decode(Craft::$app->getRequest()->getRawBody(), true);

        $data = Algolia::$plugin->algoliaService->multipleQueries($postData['queries']);

        return $this->asJson($data);
    }

    /**
     * @return mixed
     */
    public function actionBrowse()
    {
        $this->requirePostRequest();

        $postData = Json::decode(Craft::$app->getRequest()->getRawBody(), true);

        $index = $postData["index"];
        $query = $postData["query"] ?? "";
        $browseParameters = $postData["params"] ?? [];

        $data = Algolia::$plugin->algoliaService->browse($index, $query, $browseParameters);

        return $this->asJson($data);
    }
}
