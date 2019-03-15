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

        $index = Craft::$app->request->getBodyParam("index");
        $query = Craft::$app->request->getBodyParam("query") ?? "";
        $params = Craft::$app->request->getBodyParam("params");

        $searchParameters = isset($params) ? json_decode($params, TRUE) : [];

        $data = Algolia::$plugin->algoliaService->search($index, $query, $searchParameters);

        return $this->asJson($data);
    }

    /**
     * @return mixed
     */
    public function actionMultipleQueries()
    {
        $this->requirePostRequest();

        $q = Craft::$app->request->getBodyParam("queries");

        $queries = isset($q) ? json_decode($q, TRUE) : [];

        $data = Algolia::$plugin->algoliaService->multipleQueries($queries);

        return $this->asJson($data);
    }

    /**
     * @return mixed
     */
    public function actionBrowse()
    {
        $this->requirePostRequest();

        $index = Craft::$app->request->getBodyParam("index");
        $query = Craft::$app->request->getBodyParam("query") ?? "";
        $params = Craft::$app->request->getBodyParam("params");

        $browseParameters = isset($params) ? json_decode($params, TRUE) : [];

        $data = Algolia::$plugin->algoliaService->browse($index, $query, $browseParameters);

        return $this->asJson($data);
    }
}
