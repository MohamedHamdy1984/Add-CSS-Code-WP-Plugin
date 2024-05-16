<?php
/**
* @package add-css-code
*/

namespace Includes\SubPages;

use Includes\Base\PathController;

class SubpagesCallbacks 
{
    use PathController;

    public function subPages()
    {
        return require_once("$this->plugin_path/includes/SubPages/subPages.php");
    }

    public function sanitizationCallback($input)
    {
        return $input;
    }

    public function sectionCallback()
    {
        echo 'Add Your Custom CSS';
    }

    public function CodeTextField($args)
    {
        $post_type_name = $args['label_for'];
        $post_type_option = get_option('add-css-code_' . $post_type_name, []);
        $value  = isset($post_type_option['code']) ? $post_type_option['code'] : '';


        echo '<div class="form-floating" id="posts-code-textarea">
            <textarea class="form-control" placeholder="Add your CSS code here" id="'.esc_html($post_type_name).'-code" name = "add-css-code_'.esc_html($post_type_name).'[code]">' . esc_textarea($value) . '</textarea>
            <label for="'.esc_html($post_type_name).'"></label>
        </div>';
    }

    public function statusRadioField($args)
    {
        $post_type_name = $args['label_for'];
        $post_type_option = get_option('add-css-code_' . $post_type_name, []);
        $enabled = isset($post_type_option['enabled']) ? $post_type_option['enabled'] : 'enabled';
        $enabled = ($enabled == 'enabled')? true : false;



        echo '<div class="form-check">
                <input class="form-check-input" type="radio" name="add-css-code_'.esc_html($post_type_name).'[enabled]" id="'.esc_html($post_type_name).'-enable" value="enabled" ' . ($enabled? 'checked' : '') . '>
                <label class="form-check-label" for="'.esc_html($post_type_name).'-enable">
                Enable Code
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="add-css-code_'.esc_html($post_type_name).'[enabled]" id="'.esc_html($post_type_name).'-enable" value="disabled" ' . ($enabled? '' : 'checked') . '>
                <label class="form-check-label" for="'.esc_html($post_type_name).'-enable">
                Disable Code
                </label>
            </div>';
    }

}