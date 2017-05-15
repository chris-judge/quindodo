<?php

// we're firing all out initial functions at the start
function quindo_scripts_and_styles() {
    if (WP_ENV === 'production')
        $quindo_file_suffix = '.min';
    global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
    if (!is_admin()) {

        // Deregister Scripts
        wp_deregister_script('jquery');

        // Register Scripts
        wp_enqueue_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"), false, false, true);
        wp_enqueue_script('global', (get_bloginfo("template_url")."/_/js/pro/global".$quindo_file_suffix.".js?".filemtime(get_template_directory()."/_/js/pro/global".$quindo_file_suffix.".js")), false, false, true);

        // Register Styles
        wp_enqueue_style( 'application', get_bloginfo("template_url")."/_/css/application".$quindo_file_suffix.".css?".filemtime(get_template_directory()."/_/css/application".$quindo_file_suffix.".css") );
    }
}
add_action( 'wp_enqueue_scripts', 'quindo_scripts_and_styles', 16 );