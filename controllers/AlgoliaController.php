<?php
/**
 * Algolia plugin for Craft CMS
 *
 * Algolia Controller
 *
 * @author    TrendyMinds
 * @copyright Copyright (c) 2018 TrendyMinds
 * @link      https://trendyminds.com
 * @package   Algolia
 * @since     1.0.0
 */

namespace Craft;

class AlgoliaController extends BaseController
{
    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = ["actionBrowse", "actionSearch"];

    public function actionBrowse()
    {
        $this->requirePostRequest();

        $params = craft()->request->getPost();

        $index = $params["index"];
        $query = isset($params["query"]) ? $params["query"] : "";
        $attrs = isset($params["attrs"]) ? json_decode($params["attrs"], TRUE) : [];

        $data = craft()->algolia->browse($index, $query, $attrs);

        $this->returnJson($data);
    }

    public function actionSearch()
    {
        $this->requirePostRequest();

        $params = craft()->request->getPost();

        $index = $params["index"];
        $query = $params["query"];
        $attrs = isset($params["attrs"]) ? json_decode($params["attrs"], TRUE) : [];

        $data = craft()->algolia->search($index, $query, $attrs);

        $this->returnJson($data);
    }
}
