<?php
/**
* @package add-css-code
*/

namespace Includes\Base;


class Activate 
{

    public static function activate()
    {
        flush_rewrite_rules();

        $default = [];

        if( ! get_option('add-css-code_plugin')){
            update_option( 'add-css-code_plugin', $default );
        }
    }
}