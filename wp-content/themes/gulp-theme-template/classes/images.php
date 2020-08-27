<?php
/** IMAGES.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: custom image sizes, functions, and lazy loading
**/

// Support featured images
add_theme_support( 'post-thumbnails' );

// Add custom image sizes cards
add_action( 'after_setup_theme', 'sbc_theme_setup' );
function sbc_theme_setup() {
    add_image_size('builder-img', 225,0);
add_image_size('top-feature-img', 550,450, array('center, center'));
add_image_size('feature-repeater-img', 350,350, array('center, center'));
add_image_size('top-feature-img-b', 550,350, array('center, center'));
add_image_size( 'card-img', 550, 350, array('center', 'center'));
add_image_size( 'featured-img', 850, 400, array('center', 'center'));
add_image_size( 'slider-img', 1200, 776, array('center', 'center'));
add_image_size( 'site-logo', 275, 0);
add_image_size( 'larger-site-logo', 305, 0);
}

