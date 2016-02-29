<?php

// Add menus
add_theme_support( 'menus' );

// the main menu
function quindo_main_nav() {
    wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'menu' => 'The Main Menu',                      // nav name
        'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
    ));
}