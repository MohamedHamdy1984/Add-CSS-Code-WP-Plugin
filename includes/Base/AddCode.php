<?php
/**
* @package add-css-code
*/

namespace Includes\Base;


class AddCode 
{

    public $acc_option;

    public function register()
    {
        $this->acc_option = get_option( 'add-css-code_plugin', []); 

        add_action('wp_head', [$this, 'hookCSS']);
    }

    public function hookCSS()
    {
        global $post;

        if(isset($this->acc_option['whole_website'])){
            $this->getPostTypeCode('whole_website');
        }
        if(isset($this->acc_option[$post->post_type])){
            $this->getPostTypeCode($post->post_type);
        }
    }

    public function getPostTypeCode($post_type){
        $post_type_option = get_option('add-css-code_' . $post_type);

        $enabled = isset($post_type_option['enabled']) ? $post_type_option['enabled'] : 'disabled';

        if( $enabled == 'disabled' ) return;

        $css = isset($post_type_option['code'] )? ($post_type_option['code'] ) : '';
        $min_css = $this->minify_css($css);
        if(!$min_css) return;
        echo '<style id="acc-'.esc_html($post_type).'-style">'.esc_html($min_css).'</style><br>';
    }

    public function minify_css($css) {
    // Remove comments
    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);

    // Remove spaces before and after selectors, braces, and colons
    $css = preg_replace('/\s*([{}|:;,])\s+/', '$1', $css);

    // Remove remaining spaces and line breaks
    $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '',$css);
    
    return $css;
    }
}