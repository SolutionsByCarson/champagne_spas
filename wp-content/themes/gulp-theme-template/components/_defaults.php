<?php
/** GLOBAL_DEFAULTS.PHP
// ----- Version: 1.0
// ----- Released: 5.5.2020
// ----- Description: Declare build functions for all ACF elements
 * **/


function _set_defaults(){

    // set/create default value
    $defaults = array(
        'head' => 'Lorem ipsum dolor sit amet consectetur.',
        'sub' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis eros vitae nibh volutpat.',
        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis eros vitae nibh volutpat tincidunt eu egestas sem. Duis diam sem, dignissim ut nisi a, tristique cursus elit.',
        'color' => 'primary',
        'bg_color' => 'primary-bg',
        'overlay' => 'black overlay-dark',
        'bg_img' => 532,
        'link_txt' => 'Learn More',
        'icon' => '<i class="fas fa-arrow-right"></i>',
    );

    // update options if on dev
    if ( strpos(get_site_url(), 'localhost') == true ):
        update_option('sbc_defaults', $defaults);
    endif;
}
add_action('init','_set_defaults');

// ----------------------------------------------- //
// --------------- DEFAULT FUNCTIONS ------------- //
// ----------------------------------------------- //

function _default($value){
    return get_option('sbc_defaults')[$value];
}

