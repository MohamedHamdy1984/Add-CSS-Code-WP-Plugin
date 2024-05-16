<?php
/**
* @package add-css-code
*/

namespace Includes\AdminPage;

use Includes\Base\PathController;
use Includes\AdminPage\Callbacks;
use Includes\Api\SettingsApi;



class AdminPageController 
{
    use PathController;

    public $settings;
    public $callbacks;
    public $pages = [];
    
    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new Callbacks(); 

        $this->setPages();

        $this->setSettings();

        $this->setSections();

        $this->setFields();

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->register();
    }

    public function setPages()
    {
        $this->pages = [
            [
            'page_title' => 'ACC Plugin',
            'menu_title' => 'Add CSS Code',
            'capability' => 'manage_options',
            'menu_slug'  => 'add-css-code_plugin',
            'callback'   => [$this->callbacks, 'adminPage'],
            'icon_url'   => 'dashicons-edit-page',
            'position'   => 110
            ]
        ];
    }

    public function setSettings()
    {
        $args = [
            [
                'option_group' => 'add-css-code_plugin_setting',
                'option_name' => 'add-css-code_plugin',
                'callback' => [$this->callbacks, 'sanitizationCallback']
            ]
        ];
        $this->settings->setSettings($args);
    }

    public function setSections()
    {
        $args = [
            [
                'id' => 'add-css-code_admin_index',
                'title' => '',
                'callback' => [$this->callbacks, 'sectionCallback'],
                'page' => 'add-css-code_plugin'
            ]
        ];
        $this->settings->setSections($args);
    }

    public function setFields()
    {
        $args = [
            [
                'id' => 'add-css-code_Css_description',
                'title' => '',
                'callback' => [$this->callbacks, 'checkboxPostTypesField'],
                'page' => 'add-css-code_plugin',
                'section' => 'add-css-code_admin_index'
            ]
        ];
        $this->settings->setFields($args);
    }
    
}