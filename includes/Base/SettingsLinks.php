<?php
/**
* @package add-css-code
*/

namespace Includes\Base;
use \Includes\Base\PathController;

class SettingsLinks 
{
    use PathController;
    public function register(){
        add_filter('plugin_action_links_' . $this->plugin, [$this, 'settings_link']);
    }

    public function settings_link($links){
    $settings_link = '<a href="admin.php?page=add-css-code_plugin">Settings</a>';
    $links[] = $settings_link;
    return $links;
    }
}