<?php
/** THEME-OPTIONS.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: declare global options for the theme
 **/

// WordPress Dashicons - https://developer.wordpress.org/resource/dashicons/

// --------------------------------------------------------
// ---------------- Instantiate The Options Page
// --------------------------------------------------------

class Theme_Options_Page {

    /**
     * Constructor.
     */
    function __construct() {
        add_action('admin_menu',  array( $this, 'options_main' ));
        add_action('acf/init', array( $this, 'options_main' ));
        add_action('admin_menu',  array( $this, 'acf_options' ));
        add_action('acf/init', array( $this, 'acf_options' ));
        add_action('acf/input/admin_head', 'my_acf_admin_head');
//        add_action( 'admin_menu', array( $this, 'add_custom_option_page' ), 100 );
    }



    /**
     * Registers a new settings page under Settings.
     */
    function options_main() {
        acf_add_options_page(array(
            'page_title' => __('Theme Options'),
            'menu_title' => __('Theme Options'),
            'menu_slug' => 'theme-options',
            'capability' => 'manage_options',
            'position' => '3.11',
            'icon_url' => 'dashicons-welcome-widgets-menus',
            'update_button' => __('Update Theme Options', 'acf'),
            'updated_message' => __("Theme options have been updated", 'acf'),
        ));
    }

    /**
     * Registers a new settings page under Settings.
     */
    function acf_options() {
        $parent = acf_add_options_page(array(
            'page_title' => __('ACF Options'),
            'menu_title' => __('ACF Options'),
            'menu_slug' => 'acf-options',
            'capability' => 'manage_options',
            'position' => '3.11',
            'icon_url' => 'dashicons-menu-alt3',
            'update_button' => __('Update ACF Options', 'acf'),
            'updated_message' => __("Theme options have been updated", 'acf'),
        ));
        acf_add_options_sub_page(array(
            'page_title'  => __('1. ACF Fields'),
            'menu_title'  => __('1. ACF Fields'),
            'parent_slug' => $parent['menu_slug'],
        ));
        acf_add_options_sub_page(array(
            'page_title'  => __('2. ACF Elements'),
            'menu_title'  => __('2. ACF Elements'),
            'parent_slug' => $parent['menu_slug'],
        ));
        acf_add_options_sub_page(array(
            'page_title'  => __('3. ACF Components'),
            'menu_title'  => __('3. ACF Components'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }

}

new Theme_Options_Page;


// --------------------------------------------------------
// ---------------- ACF Styles
// --------------------------------------------------------


function my_acf_admin_head() {
    ?>
    <style type="text/css">

        /* Admin Label */
        #admin_label {
            padding: 0;
        }
        #admin_label > .acf-label {
            background: #aafaaa;
        }
        #admin_label > .acf-label > label {
            color: #497049;
            padding: 10px 0;
            margin: 0;
        }
        #admin_label > .acf-input {
            background: #e3ffe3
        }
        #admin_label > .acf-input > .acf-input-wrap > input {
            border:none;
            border-radius: 0;
            padding: 10px 0;
            background: none;
            color: #497049;
            height: 38px;
        }
        div#elem_tab > .acf-input > .acf-repeater.-row tr.acf-row.-collapsed > .acf-fields > #field_head,
        .acf-repeater .acf-row.-collapsed>.acf-fields>#admin_label {
            display: block !important;
        }


        /* Hide Label */
        .hide_label > .acf-label {
            display: none !important;
        }

        /*ACF Element Class*/
        /*.acf_elem > .acf-input > .acf-fields {*/
        /*    display: flex;*/
        /*    !*width: 100%;*!*/
        /*    flex-wrap: wrap;*/
        /*    flex-direction: row;*/
        /*}*/

        /*.acf_elem > .acf-input > .acf-fields > .acf-tab-wrap.-top {*/
        /*    width: 100%*/
        /*}*/

        .acf_elem > .acf-input > .acf-fields > .acf-field:not(:first-child) {
            border-left: #ccd0d4 solid 1px;
        }

        .acf_elem > .acf-input > .acf-fields > .acf-field-clone {
            /*padding: 0;*/
        }
        .acf_elem > .acf-input > .acf-fields > .acf-field-clone > .acf-label {
            display: none;
        }
        .acf_elem > .acf-input > .acf-fields > .acf-field-clone > .acf-input > .acf-clone-fields {
            border: none;
            padding: 0;
        }
        .acf_elem > .acf-input > .acf-fields > .acf-field-clone > .acf-input > .acf-clone-fields > .acf-field {
            padding: 0;
        }

        /* Element - Text Link [txt_link] */
        #elem_txt_link > .acf-input > .acf-fields {
            display: flex;
            /*width: 100%;*/
            flex-wrap: wrap;
            flex-direction: row;
        }
        #elem_txt_link > .acf-input > .acf-fields > #field_txt { width: 50%; }
        #elem_txt_link > .acf-input > .acf-fields > #field_link { width: 50%; }
        #elem_txt_link > .acf-input > .acf-fields > #field_link_target { width: 25%; }
        #elem_txt_link > .acf-input > .acf-fields > #field_size { width: 25%; }
        #elem_txt_link > .acf-input > .acf-fields > #field_icon { width: 50%; }

        /*!* Element - Button [btn] *!*/
        #elem_btn > .acf-input > .acf-fields {
            display: flex;
            /*width: 100%;*/
            flex-wrap: wrap;
            flex-direction: row;
        }
        #elem_btn > .acf-input > .acf-fields > #field_txt { width: 50%; }
        #elem_btn > .acf-input > .acf-fields > #field_link { width: 50%; }
        #elem_btn> .acf-input > .acf-fields > #field_link_target,
        #elem_btn> .acf-input > .acf-fields > #field_style,
        #elem_btn> .acf-input > .acf-fields > #field_color,
        #elem_btn> .acf-input > .acf-fields > #field_size { width: 12.5% }
        #elem_btn > .acf-input > .acf-fields > #field_icon { width: 50%; }

        /*!* Element - Button Group [btn_group] *!*/
        #elem_btn_group .acf-table .acf-row > .acf-field.acf-field-clone {
            padding: 0;
        }
        #elem_btn_group .acf-table .acf-row > .acf-field.acf-field-clone > .acf-input > .acf-clone-fields {
            border: none;
        }
        #elem_btn_group .acf-table .acf-row > .acf-field.acf-field-clone #elem_btn {
            padding: 0;
        }
        #elem_btn_group .acf-table .acf-row > .acf-field.acf-field-clone #elem_btn > .acf-label {
            display: none;
        }
        #elem_btn_group .acf-table .acf-row > .acf-field.acf-field-clone #elem_btn > .acf-input > .acf-fields {
            border: none;
        }
        #elem_btn_group .acf-table .acf-row > .acf-field.acf-field-clone #elem_btn > .acf-input > .acf-fields > .acf-field {
            border-top: none;
            border-right: none;
            border-bottom: none;
        }
        /*#elem_btn_group .acf-row > .acf-field-clone > .acf-input {*/
        /*    padding: 0;*/
        /*}*/
        #elem_btn_group .acf-row .acf-field-clone:before,
        #elem_btn_group .acf-row .acf-field-clone > .acf-label {
            width: 9%;
        }
        #elem_btn_group .acf-row .acf-field-clone > .acf-input {
            width: 91%;
        }
        #elem_btn_group .acf-row .acf-field-clone > .acf-input > .acf-clone-fields {
            border: none;
        }

        #elem_btn_group .acf-row .acf-field-clone > .acf-input > .acf-clone-fields > #elem_btn {
            padding: 0;
        }

        #elem_btn_group .acf-row .acf-field-clone > .acf-input > .acf-clone-fields > #elem_btn > .acf-label {
            display: none;
        }

        /*!* Element - Background [bg] *!*/
        #elem_bg > .acf-input > .acf-fields {
            display: flex;
            width: 100%;
            flex-wrap: wrap;
            flex-direction: row;
        }
        #elem_bg > .acf-input > .acf-fields > #field_style {
            width: 100%;
        }
        #elem_bg > .acf-input > .acf-fields > #field_color,
        #elem_bg > .acf-input > .acf-fields > #field_img {
            width: 100%;
        }

        /*!* Element - Attributes [atts] *!*/
        #elem_atts > .acf-input > .acf-fields {
            display: flex;
            width: 100%;
            flex-wrap: wrap;
            flex-direction: row;
        }
        #elem_atts > .acf-input > .acf-fields > #field_class,
        #elem_atts > .acf-input > .acf-fields > #field_id,
        #elem_atts > .acf-input > .acf-fields > #field_show_other_atts {
            width: 50%;
        }
        #elem_atts > .acf-input > .acf-fields > #elem_other_atts {
            width: 100%;
        }
        #elem_atts > .acf-input > .acf-fields > #elem_other_atts {
            border-left: none;
        }

        /*!* Component - Hero Slider [hero_slider] *!*/

        .comp_tabs > .acf-input > .acf-fields.-top.-border.-sidebar,
        #comp_hero > .acf-input > .acf-fields.-top.-border.-sidebar,
        #comp_hero_slider > .acf-input > .acf-fields.-top.-border.-sidebar {
            padding-left: 12% !important;
        }
        .comp_tabs > .acf-input > .acf-fields.-top.-border.-sidebar:before,
        #comp_hero > .acf-input > .acf-fields.-top.-border.-sidebar:before,
        #comp_hero_slider > .acf-input > .acf-fields.-top.-border.-sidebar:before {
            width: 12% !important;
        }
        .comp_tabs > .acf-input > .acf-fields > .acf-tab-wrap.-left > .acf-tab-group,
        #comp_hero > .acf-input > .acf-fields > .acf-tab-wrap.-left > .acf-tab-group,
        #comp_hero_slider > .acf-input > .acf-fields > .acf-tab-wrap.-left > .acf-tab-group {
            width: 12% !important;
        }


        #comp_hero:before {
            display: none !important;
        }

        #comp_hero > .acf-label {
            width: 100%;
            float: none;
            margin-bottom: 10px;
        }

        #comp_hero > .acf-input {
            width: 100%;
            float: none;
        }

        #hero_slides {
            border: none;
        }
        #hero_slides:before {
            display: none;
        }
        #hero_slides > .acf-label {
            display: none;
        }
        #hero_slides > .acf-input {
            width: 100%;
            float: none;
            padding: 0;
        }
        #hero_slides #comp_hero {
            padding: 0;
            border: none;
        }
        #hero_slides > .acf-input > .acf-clone-fields {
            border: none;
        }
        #hero_slides #comp_hero:before { display: none; }
        #hero_slides #comp_hero > .acf-label {
            float: none;
            width: 100%;
            margin-bottom: 10px;
        }
        #hero_slides #comp_hero > .acf-input {
            width: 100%;
            float: nonep;
        }

        /* Tabs */
        div#elem_accordion > .acf-input > .acf-repeater.-row tr.acf-row.-collapsed > .acf-fields > #field_head,
        div#elem_tab > .acf-input > .acf-repeater.-row tr.acf-row.-collapsed > .acf-fields > #field_head {
            display: block !important;
        }

        .field-id-label {
            display: block;
            padding: 0;
            font-size: 12.5px;
            font-style: italic;
            margin: 2px 0;
            color: #666;
        }

        .field-id-label:before {
            content: "ID";
            display: inline;
            margin-right: 7px;
            font-style: normal;
        }


    </style>
    <?php
}

// --------------------------------------------------------
// ---------------- Theme Functions
// --------------------------------------------------------


/**
 * Construct functions page.
 * Preloader - saves pages html to database
 * Function below clears the preloader of any caches -- Will we use this?
 */
function theme_function_build(){


    // Reset Preloader Values
    if (isset($_GET['refresh-preloader'])) {
        echo '<div id="message" class="updated fade"><p>';
        reset_all_Preloader();
        echo '</p></div>';
    }



    ?>
    <div class="wrap">
        <h1><?php _e( 'Theme Functions', 'textdomain' ); ?></h1>
        <?php echo '<p><a href="'.admin_url('admin.php?page=theme-functions&refresh-preloader').'">'.__('Empty All Preloaders', 'textdomain').' &raquo;</a></p>'; ?>
    </div>
    <?php
}
