<?php 

function wporg_add_custom_box()
{
    $screens = ['post', 'slider'];  // Posttype name mention there 
    foreach ($screens as $screen) {
        add_meta_box(
            'wporg_box_id',           // Unique ID
            'Slider Button',  // Box title
            'wporg_custom_box_html',  // Content callback, must be of type callable
            $screen                   // Post type
        );
    }
}
add_action('add_meta_boxes', 'wporg_add_custom_box');

function wporg_custom_box_html($post)
{
    $value = get_post_meta($post->ID, '_wporg_meta_key', true);
    ?>
    <label for="wporg_field">Add Text</label>
    <br>    
    <input name="wporg_field" type="text"  id="wporg_field" value="<?=  $value ?>" class="postbox">
    <?php
}

function wporg_save_postdata($post_id)
{
    if (array_key_exists('wporg_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_wporg_meta_key',
            $_POST['wporg_field']
        );
    }
}
add_action('save_post', 'wporg_save_postdata');
    
 ?>
 ?>


 ------------------------------------------HOW TO GET META BOX-------------------------------
 <a href="<?php echo get_permalink(); ?>"><?php echo get_post_meta($post->ID, '_wporg_meta_key', true) ?></a>