<?php
/**
* @package add-css-code
*/

namespace Includes\AdminPage;

use Includes\Base\PathController;

class Callbacks 
{
    use PathController;

    public function adminPage()
    {
        return require_once("$this->plugin_path/includes/AdminPage/adminPage.php");
    }

    public function sanitizationCallback($input)
    {
        if(isset($_POST['remove'], $_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'add-css-code_plugin_setting-options')){
            
            $post_type_name = $_POST['remove'];
            $output = get_option('add-css-code_plugin', []);

            unset($output[$post_type_name]);
            delete_option('add-css-code_' . $post_type_name);
            return $output;
        }
        return $input;
    }

    public function sectionCallback()
    {
        echo 'Choose whatever Post types you want to add Custom CSS to it';
    }

    public function checkboxPostTypesField()
    {
        $checked = '';

        $option = get_option('add-css-code_plugin', []);
        
        $post_types = get_post_types(['show_ui' => true], 'objects');
        $unwanted = ['attachment', 'wp_block', 'wp_navigation'];

        
        echo '<div class="row">';

        // Code for whole website editing
        echo '<div class="col-5 m-2">
                <input type="checkbox" class="btn-check" id="website" autocomplete="off" name="add-css-code_plugin[whole_website]" value="Whole Website" '. (isset($option["whole_website"]) ? 'checked onclick="return false;"' : '')  .' >
                <label class="btn btn-outline-primary" for="website">Whole Website</label>
                </div>';
        
        // Code for each post type editing
        foreach($post_types as $post){
            if(in_array($post->name, $unwanted)) continue;
            $checked = isset($option[$post->name]);
            
            echo '<div class="col-5 m-2">
                <input type="checkbox" class="btn-check" id="'.esc_html($post->name).'" autocomplete="off" name="add-css-code_plugin['.esc_html($post->name).']" value="'.esc_html($post->label).'" '. ($checked ? 'checked onclick="return false;"' : '')  .' >
                <label class="btn btn-outline-primary" for="'.esc_html($post->name).'">'.esc_html($post->label).'</label>
                </div>';            
        }
        echo '</div>';

    }
}