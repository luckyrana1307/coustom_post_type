<?php
/**
 * Plugin Name: wp-coustom-post-type
 * Description: This powerful plugin allows creating a custom Post Type
 *  * Author:      Brainstorm Force, Nikhil Chavan
 * Author URI:  lucky
 * Domain Path: /languages
 * Version: 1.6.37

 *
 * @package         header-footer-elementor
 */

 add_action('init', 'wpl_cpt_register_movies');

 function wpl_cpt_register_movies() {
    $supports = array(
        'title',
        'editor',
        'author',
        'thumbnail',

        'comments',
        'excerpt',
        'revisions',
        'post-formats',
    );
    $labels = array(
        'name' => _x('Movie', 'plural'),
        'title_name' => __('Movie', 'singular'),
        'menu_name' => __('Movie', 'admin menu'),
        'name_admin' => __('movie', 'admin bar'),
        'add_new' => __('Add Movie', 'add new'),
        'add_new_item' => __('Add New news'),
        'new_item' => __('New Movie'),
        'edit_item' => __('Edit Movie'),
        'view_item' => __('View Movie'),
        'all_items' => __('All Movies'),
        'search_items' => __('Search Movie'),
        'not_found' => __('No Movie found.'),
        'not_found_in_trash'=> __('No Movie found.in Trash'),
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'movie'),

    );
    register_post_type( 'movie', $args );
}

function wpl_cpt_register_metabox(){
    add_meta_box('cpt-id','Producer Details','wpl_owt_cpt_producer_call','movie','side','high');
}
add_action('add_meta_boxes', 'wpl_cpt_register_metabox');

function wpl_owt_cpt_producer_call($post){
    ?>
  
    <p>
        <label for="">Name:</label>
        <?php $name = get_post_meta($post->ID,'wpl_producer_name',true )?>
        <input type="text"  value="<?php echo $name ;?>" name="txtProducerName" placeholder="Name">
    </p>
    <p>
        <label for="">Email:</label>
        <?php $email = get_post_meta( $post->ID, 'wpl_producer_email', true )?>
        <input type="email" value ="<?php echo $email;?>" name="txtProducerEmail" placeholder="Email">
    </p>


    <?php

}

function wpl_owt_cpt_save_values($post_id,$post){

    $txtProducerName = isset($_POST['txtProducerName'])? $_POST['txtProducerName']:"";
    $txtProducerEmail = isset($_POST['txtProducerEmail'])? $_POST['txtProducerEmail']:"";

    update_post_meta($post_id,"wpl_producer_name",$txtProducerName);
    update_post_meta($post_id,"wpl_producer_email",$txtProducerEmail);
}

add_action( "save_post","wpl_owt_cpt_save_values",10,2 );
