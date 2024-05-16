<?php
/** 
 * Plugin Name: Add CSS Code
 * Plugin URI: https://mohamdyweb.com/add-css-code-plugin/
 * Description: Take control of your website's design without the worry of altering core theme files.
 * Version: 1.0.0
 * Requires at least: 5.0
 * Author: Mohamed Hamdy
 * Author URI: https://mohamdyweb.com/
 * License: GPLv2 or later
 * Text Domain: add-css-code
 * Domain Path: /languages
 */

 
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License C
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2023 Automattic, Inc.
*/

if( ! defined('ABSPATH')){
    die;
}

if ( file_exists( dirname ( __FILE__ ) . '/vendor/autoload.php')){
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

if(! function_exists('add_css_code_activate_acc_plugin')){
    function add_css_code_activate_acc_plugin(){
        Includes\Base\Activate::activate();
    }
    register_activation_hook( __FILE__, 'add_css_code_activate_acc_plugin' ); 
}

if(! function_exists('add_css_code_deactivate_acc_plugin')){
    function add_css_code_deactivate_acc_plugin(){
        Includes\Base\Deactivate::deactivate();
    }
    register_deactivation_hook( __FILE__, 'add_css_code_deactivate_acc_plugin' ); 
}

if(class_exists('Includes\\Init')){
    Includes\Init::register_services();
}


