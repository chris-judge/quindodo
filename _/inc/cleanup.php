<?php

// Add RSS links to <head> section
automatic_feed_links();

// Clean up the <head>
function quindo_head_cleanup() {
    // EditURI link
    remove_action('wp_head', 'rsd_link');
    // windows live writer
    remove_action('wp_head', 'wlwmanifest_link');
    // WP version
    remove_action('wp_head', 'wp_generator');
    // remove WP version from css
    add_filter( 'style_loader_src', 'quindo_remove_wp_ver_css_js', 9999 );
    // remove Wp version from scripts
    add_filter( 'script_loader_src', 'quindo_remove_wp_ver_css_js', 9999 );
    // previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    // start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    // links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
}
add_action('init', 'quindo_head_cleanup');

// remove WP version from scripts
function quindo_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove WP version from RSS
function quindo_rss_version() { return ''; }
add_filter( 'the_generator', 'quindo_rss_version' );


// Set up body class
function quindo_body_class($classes) {
    $classes[] = basename(get_permalink());
    return $classes;
}
add_filter('body_class', 'quindo_body_class');


// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function quindo_filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter( 'the_content', 'quindo_filter_ptags_on_images' );