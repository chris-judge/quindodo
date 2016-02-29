<?php
    /* ----------------------------------------------------------------------------
     Config
    -------------------------------------------------------------------------------*/

    // Configuration values
    define('GOOGLE_ANALYTICS_ID', false); // UA-XXXXX-Y

    if (!defined('WP_ENV')) {
        define('WP_ENV', 'production');
    }


    /* ----------------------------------------------------------------------------
     Include Files
    -------------------------------------------------------------------------------*/

    // Admin Section
    include('_/inc/admin.php');

    // Wp_head Clean Up
    include('_/inc/cleanup.php');

    // Styles, Scripts, & Enqueueing
    include('_/inc/scripts.php');

    // Custom Theme Utility Functions
    include('_/inc/utilities.php');

    // Featured Images and Image Sizes
    // include('_/inc/images.php');

    // Custom Post Types / Taxonomies
    // include('_/inc/post_types.php');

    // Custom Nav
    // include('_/inc/nav.php');

    /* ----------------------------------------------------------------------------
     Hide Admin Menu
    -------------------------------------------------------------------------------*/
    
    add_filter('show_admin_bar', '__return_false');

    /* ----------------------------------------------------------------------------
     Live Reload
    -------------------------------------------------------------------------------*/
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
      wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
      wp_enqueue_script('livereload');
    }

?>