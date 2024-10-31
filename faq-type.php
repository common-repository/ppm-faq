<?php
/* Some setup */
define('PPM_FAQ_NAME', "FAQs");
define('PPM_FAQ_SINGLE', "FAQ");
define('PPM_FAQ_TYPE', "ppm-faq");
define('PPM_FAQ_ADD_NEW_ITEM', "Add New FAQ");
define('PPM_FAQ_EDIT_ITEM', "Edit FAQ");
define('PPM_FAQ_NEW_ITEM', "New FAQ");
define('PPM_FAQ_VIEW_ITEM', "View FAQ");

/* Register custom post for FAQ*/
function ppm_FAQ_custom_post_register() {  
    $args = array(  
        'labels' => array (
			'name' => __( PPM_FAQ_NAME ),
			'singular_label' => __(PPM_FAQ_SINGLE),  
			'add_new_item' => __(PPM_FAQ_ADD_NEW_ITEM),
			'edit_item' => __(PPM_FAQ_EDIT_ITEM),
			'new_item' => __(PPM_FAQ_NEW_ITEM),
			'view_item' => __(PPM_FAQ_VIEW_ITEM),
		), 
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor')  
       );  
    register_post_type(PPM_FAQ_TYPE , $args );  
}
add_action('init', 'ppm_FAQ_custom_post_register');

?>