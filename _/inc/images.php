<?php

// Add featured images
add_theme_support( 'post-thumbnails' );    

// Thumbnail sizes
//add_image_size( 'quindo-thumb-600', 600, 150, true );

// Add thumbnail options to select in media manager
function quindo_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'quindo-thumb-600' => __('600px by 150px'),
    ) );
}
//add_filter( 'image_size_names_choose', 'quindo_custom_image_sizes' );