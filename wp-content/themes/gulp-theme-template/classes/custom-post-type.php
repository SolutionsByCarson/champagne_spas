
<?php
/** CUSTOM-POST-TYPE.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: How to build custom post type and custom taxonomy
 **/


// --------------------------------------------------------
// ---------------- Create Custom Post Type
// --------------------------------------------------------
function create_teammembers() {

    register_post_type( 'team-members',
        array(
            'labels' => array(
                'name' => __( 'Team Members' ),
                'singular_name' => __( 'Team Member' ),
                'add_new' => _x('Add New', 'add new'),
                'add_new_item' => __('Add New Team Member'),
                'new_item' => __('New Team Member'),
                'menu_name' => __('Team Members')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'team_member'),
            'menu_icon' => 'dashicons-universal-access',
            'show_in_menu' => true,
            'menu_position' => 5,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
        ));
}
add_action( 'init', 'create_teammembers' );


// --------------------------------------------------------
// ---------------- Create Custom Taxonomy
// --------------------------------------------------------
function create_schools_taxonomies() {
    register_taxonomy(
        'setting',
        array( 'schools' ),
        array(
            'label' => __( 'Setting' ),
            'rewrite' => array( 'slug' => 'setting' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'create_schools_taxonomies', 0 );

