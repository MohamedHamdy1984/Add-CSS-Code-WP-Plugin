<section id="add-css-code-subpage-page" class="m-4">
    <h2 class="m-3 p-4"><span class="plugin-special-font">ACC</span> <mark>(Add-CSS-Code)</mark> Post Type Manager</h2>

    <?php settings_errors(); ?>

    <form method="post" action="options.php" id="code-editor-form">
        <?php 

            // Get the post type from the current url 
            
            $screen = get_current_screen();
            $post_type_with_css = preg_replace("/add-css-code_page_/", '', $screen->base);
            $post_type = preg_replace("/_css$/", '', $post_type_with_css);
        
            settings_fields( 'add-css-code_' . $post_type . '_setting' );
            do_settings_sections(  $post_type . '_css' );

            submit_button('Save Code');
        ?>
    </form>


</section>
