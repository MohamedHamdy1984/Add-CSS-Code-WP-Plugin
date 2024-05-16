<?php
/**
* @package add-css-code
*/
namespace Includes\Base;

class Deactivate
{
    public static function deactivate(){
        flush_rewrite_rules();
    }
}