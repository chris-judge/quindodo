<?php


// Adding is login page function
function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

// Remove unwanted items from admin menu
function quindo_remove_admin_menu_items() {
    $remove_menu_items = array(__('Posts'),__('Comments'),);
    global $menu;
    end ($menu);
    while (prev($menu)){
        $item = explode(' ',$menu[key($menu)][0]);
        if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
        unset($menu[key($menu)]);}
    }
}
add_action('admin_menu', 'quindo_remove_admin_menu_items');    

// Register styles for WYSIWYG editor
function quindo_editor_styles() {
    if (WP_ENV === 'production')
        $quindo_file_suffix = '.min';
    add_editor_style( '_/css/editor-style'.$quindo_file_suffix.'.css' );
}
add_action( 'after_setup_theme', 'quindo_editor_styles' );

// Allow Thumbnails in Posts
add_theme_support( 'post-thumbnails' );

// Disable admin editor. Should be in config.php but let's add it here just in case
define('DISALLOW_FILE_EDIT', TRUE);

// Change Excerpt notation
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');