<?php
/**
 * Trigger this file on pluguin uninstall
 * 
 * @package add-css-code
 */

 if( ! defined('WP_UNINSTALL_PLUGIN')){
    die;
 }


$acc_plugin_option = get_option('add-css-code_plugin', []);

foreach($acc_plugin_option as $post_type_name=>$label){
   delete_option('add-css-code_' . $post_type_name);
}

delete_option( $acc_plugin_option );