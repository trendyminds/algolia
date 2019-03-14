<?php
/**
 * Algolia plugin for Craft CMS 3.x
 *
 * Easily pull search results from Algolia into your Craft CMS website
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\algolia\assetbundles\Algolia;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    TrendyMinds
 * @package   Algolia
 * @since     2.0.0
 */
class AlgoliaAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@trendyminds/algolia/assetbundles/algolia/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Algolia.js',
        ];

        $this->css = [
            'css/Algolia.css',
        ];

        parent::init();
    }
}
