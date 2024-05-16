<?php
/**
* @package add-css-code
*/

namespace Includes\SubPages;

// use Includes\Base\IsSubpageActivated;
use Includes\Base\PathController;
use Includes\SubPages\SubpagesCallbacks;
use Includes\Api\SettingsApi;



class SubPagesController 
{
    use PathController;
    // use IsSubpageActivated;

    public $settings;

	public $callbacks;

	public $subpages = [];

	public $acc_option;

    
    public function register()
    {
        $this->acc_option = get_option( 'add-css-code_plugin'); 
        if( ! $this->acc_option) return;


        $this->settings = new SettingsApi();

        $this->callbacks = new SubpagesCallbacks(); 

        $this->setSubpages();

        $this->setSettings();

        $this->setSections();

        $this->setFields();

        $this->settings->addSubPages( $this->subpages )->register();
    }

    public function setSubpages()
	{
        foreach($this->acc_option as $post_type_name=>$label){
            $this->subpages[] = [
                    'parent_slug' => 'add-css-code_plugin', 
                    'page_title' => $label . 'CSS Editor', 
                    'menu_title' => $label.' CSS Editor', 
                    'capability' => 'manage_options', 
                    'menu_slug' => $post_type_name .'_css', 
                    'callback' => array( $this->callbacks, 'subPages' )
                ];
        }
	}

    public function setSettings()
    {
        $args = [];
        foreach($this->acc_option as $post_type_name=>$label){
            $args[] = [
                    'option_group' => 'add-css-code_'.$post_type_name.'_setting',
                    'option_name' => 'add-css-code_'.$post_type_name,
                    'callback' => [$this->callbacks, 'sanitizationCallback']
                ];
        }
        $this->settings->setSettings($args);
    }

    public function setSections()
    {
        $args = [];
        foreach($this->acc_option as $post_type_name=>$label){
            $args[] = [
                    'id' => 'add-css-code_'.$post_type_name.'_section',
                    'title' => $label . ' Section',
                    'callback' => [$this->callbacks, 'sectionCallback'],
                    'page' => $post_type_name .'_css'
                ];
        }

        $this->settings->setSections($args);
    }

    public function setFields()
    {
        $args = [];
        foreach($this->acc_option as $post_type_name=>$label){
            $args[] = [
                'id'        => 'add-css-code_'.$post_type_name.'_field',
                'title'     => $label.' Code Editor',
                'callback'  => [$this->callbacks, 'CodeTextField'],
                'page'      => $post_type_name .'_css',
                'section'   => 'add-css-code_'.$post_type_name.'_section',
                'args'      => [
                    'label_for'   =>  $post_type_name
                ]
            ];
            $args[] = [
                'id'        => 'add-css-code_'.$post_type_name.'_status',
                'title'     => $label.' Code Status',
                'callback'  => [$this->callbacks, 'statusRadioField'],
                'page'      => $post_type_name .'_css',
                'section'   => 'add-css-code_'.$post_type_name.'_section',
                'args'      => [
                    'label_for'   =>  $post_type_name
                ]
            ];
        }
        $this->settings->setFields($args);
    }
}