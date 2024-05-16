<section id="add-css-code-admin-page" class="m-4">
    <h2 class="m-3 p-4"><span class="plugin-special-font">ACC</span> <mark>(Add-CSS-Code)</mark> Plugin Manager</h2>
    <?php settings_errors(); ?>

    <div class=" container">
            <h4>Post types with Custom CSS</h4>
    </div>

    <div class="row">
        <div class="add-css-code-table-posts">
            <table class="table table-striped table-hover mt-2">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Post type</th>
                        <th scope="col">Code status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php 
                        $option = get_option('add-css-code_plugin') ?: [];

                        $plugin_url = admin_url('admin.php?page=');
                        $i=1;
                        foreach($option as $post_type_name=>$label){
                            $post_type_option = get_option('add-css-code_' . $post_type_name, []);
                            $enabled = isset($post_type_option['enabled']) ? $post_type_option['enabled'] : 'enabled'; 
                            $enabled = ($enabled == 'enabled')? true : false;
                            
                            echo '<tr>
                                    <th scope="row">'.absint($i).'</th>
                                    <td>'.esc_html($label).'</td>
                                    <td>'.($enabled? "Enabled" : "Disabled").'</td> 
                                    <td>
                                        <a href="'.esc_url($plugin_url) . esc_html($post_type_name) .'_css" class="button button-primary">Edit</a>';

                            /** Delete custom code for post type */
                            echo '<form method="post" action="options.php" class="d-inline-block ms-2">';
                            settings_fields( 'add-css-code_plugin_setting' );
                            echo '<input type="hidden" name="remove" value="'.esc_html($post_type_name).'">';
                            submit_button('Delete', 'delete', 'submit', false, [
                                'onclick' => 'return confirm("Are you sure? This will delete the code from the database\n \n You can instead disable the code in its page");'
                            ]);
                                        
                            echo    '</form></td>
                                </tr>';

                            $i++;
                        }
                    ?>
                    
                </tbody>
                
            </table>
            <div class="btn-wrap m-2">
                <span data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Select Post type to apply your Custom CSS">
                    <!-- Button trigger modal For Add new Post Type-->
                    <button type="button" class="button button-primary button-large" data-bs-toggle="modal" data-bs-target="#addPostTypeModal" >
                        Add
                    </button>
                </span>
            </div>
        </div> 
    </div>


<!-- Modal For Add new Post Type => submit button-->
<div class="modal fade" id="addPostTypeModal" tabindex="-1" aria-labelledby="addPostTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPostTypeModalLabel">Choose Post type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="options.php">
                <div class="modal-body">
                        <?php 
                            settings_fields( 'add-css-code_plugin_setting' );
                            do_settings_sections( 'add-css-code_plugin' );
                        ?>
                </div>
                <div class="modal-footer">
                    
                    <?php submit_button('Add Post type', 'primary'); ?>
                </div>
            </form>
            
            </div>
        </div>
    </div>
<!-- End Add new Post Type Modal -->
