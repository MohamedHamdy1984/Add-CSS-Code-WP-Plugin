<?php
/**
* @package add-css-code
*/

namespace Includes\Base;

use Includes\Base\PathController;


/**
 * Load CSS & JS files to our Plugin admin pages
 * Ceck if we are in our plugin pages within enqueu function to load our files only in our plugin pages
 */
class Enqueue
{
    use PathController;
    public $current_post_type_name;
    public $isMainPage;


    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']); 
    }

    public function enqueue()
    {
        //enqueueing our assets only in our admin oages
        global $parent_file;
        if ('add-css-code_plugin' != $parent_file) {
            return;
        } 
        
        wp_enqueue_style( 'bootstrapCss', $this->plugin_url . 'assets/css/bootstrap.min.css', [], true );
        wp_enqueue_style( 'pluginStyle', $this->plugin_url . 'assets/css/mystyle.css', [], true );
        wp_enqueue_script( 'bootstrapJs', $this->plugin_url . 'assets/js/bootstrap.bundle.min.js', [], true, true);
        wp_enqueue_script( 'mainJs', $this->plugin_url . 'assets/js/mohamdyMain.js', [], true, true);



        
        $this->getScreenData();
        
        //enqueueing Code Mirror only at sup pages
        if(! $this->isMainPage){
            $cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css'));
            $cm_settings['postType'] = $this->current_post_type_name;
            wp_localize_script('mainJs', 'cm_settings', $cm_settings);
            wp_enqueue_script('wp-theme-plugin-editor');
            wp_enqueue_style('wp-codemirror');
        }
    }


    // 
    public function getScreenData()
    {
        $screen = get_current_screen();

        if($screen->base == 'toplevel_page_add-css-code_plugin')
        {
            $this->isMainPage = true;
        } else {
            $this->isMainPage = false;
            
            $post_type_with_css = preg_replace("/add-css-code_page_/", '', $screen->base);
            $this->current_post_type_name = preg_replace("/_css$/", '', $post_type_with_css);
        }
    }
}