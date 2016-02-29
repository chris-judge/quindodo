<?php

// Custom post type
function quindo_post_type_custom() { 
    register_post_type( 'custom_type',
        array( 
        )
    );
    
    /* this adds your post categories to your custom post type */
    register_taxonomy_for_object_type( 'category', 'custom_type' );
    
}
add_action( 'init', 'quindo_post_type_custom');
    
// Add custom taxonomy
register_taxonomy( 'custom_cat', array(), array() );