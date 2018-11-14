<?php
/**
 * Algolia plugin for Craft CMS
 *
 * Interface with Algolia through Craft CMS
 *
 * @author    TrendyMinds
 * @copyright Copyright (c) 2018 TrendyMinds
 * @link      https://trendyminds.com
 * @package   Algolia
 * @since     1.0.0
 */

namespace Craft;

require __DIR__ . '/vendor/autoload.php';

class AlgoliaPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return "Algolia";
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return "Interface with Algolia through Craft CMS";
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'TrendyMinds';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'https://trendyminds.com';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     */
    public function onBeforeInstall()
    {
    }

    /**
     */
    public function onAfterInstall()
    {
    }

    /**
     */
    public function onBeforeUninstall()
    {
    }

    /**
     */
    public function onAfterUninstall()
    {
    }

    /**
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'applicationId' => array(AttributeType::String, 'label' => 'Application ID', 'default' => ''),
            'apiKey' => array(AttributeType::String, 'label' => 'API Key', 'default' => ''),
        );
    }

    /**
     * @return mixed
     */
    public function getSettingsHtml()
    {
       return craft()->templates->render('algolia/Algolia_Settings', array(
           'settings' => $this->getSettings()
       ));
    }

    /**
     * @param mixed $settings  The plugin's settings
     *
     * @return mixed
     */
    public function prepSettings($settings)
    {
        return $settings;
    }
}
