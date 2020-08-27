<?php

// Classes
require_once( __DIR__ . '/classes/admin.php');
//require_once( __DIR__ . '/classes/breadcrumb.php');         //** needs optimization
require_once( __DIR__ . '/classes/custom-fields.php');
//require_once( __DIR__ . '/classes/custom-post-type.php');   ** needs optimization
require_once( __DIR__ . '/classes/images.php');
require_once( __DIR__ . '/classes/menus.php');
//require_once( __DIR__ . '/classes/queries.php');            ** needs optimization
//require_once( __DIR__ . '/classes/site-search.php');        ** needs optimization
//require_once( __DIR__ . '/classes/structured-data.php');    ** needs optimization
require_once( __DIR__ . '/classes/theme-options.php');
require_once( __DIR__ . '/classes/utilities.php');
require_once( __DIR__ . '/classes/widgets.php');


// Components
require_once( __DIR__ . '/components/_defaults.php');
require_once( __DIR__ . '/components/elements.php');
//require_once( __DIR__ . '/components/options.php');
//require_once( __DIR__ . '/components/card.php');
//require_once( __DIR__ . '/components/featured-card.php');
require_once( __DIR__ . '/components/modal.php');


// Sections
//require_once( __DIR__ . '/sections/card-section.php');
//require_once( __DIR__ . '/sections/parent-page-header.php');
//require_once ( __DIR__ . '/sections/child-page-header.php');


// Enqueue Styles and Scripts based on page template
function enqueue_global_assets()
{

    // JQuery JS - swap WordPress' default and re-register
    if ( strpos(get_site_url(), 'localhost') == true ):
        wp_deregister_script('jquery'); // Disable WordPress' own version of JQuery, cf. http://wordpress.stackexchange.com/questions/189310/how-to-remove-default-jquery-and-add-js-in-footer
        wp_register_script( 'jQuery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', false );
        wp_enqueue_script('jQuery');
    endif;

    // Enqueue Global Styles/Scripts
    wp_enqueue_style('global-styles', get_template_directory_uri() . '/dist/css/global.css', array(), '1.0.0', 'all');
    wp_enqueue_script('global-scripts', get_template_directory_uri() . '/dist/js/global.js', array(), '1.0.0', false);


}
add_action('wp_enqueue_scripts', 'enqueue_global_assets');


function submitToSharpSpring($data, $baseURI, $endPoint) {
    $params = '';
    foreach($data as $key => $value) {
        if(!is_array($value)) {
            $params = $params . $key . '=' . urlencode($value) . "&";
        }
        else {
            $params = $params . $key . '=' . urlencode(implode(',',$value)) . "&";
        }
    }

    if (isset($_COOKIE['__ss_tk'])) {
        $trackingid__sb = $_COOKIE['__ss_tk'];
        $params = $params . "trackingid__sb=" . urlencode($trackingid__sb);
    }
    // Prepare URL
    $ssRequest = $baseURI . $endPoint . "/jsonp/?" . $params;
    // Send request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ssRequest);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    ob_start();
    var_dump($data);
    $data_dump = ob_get_clean();
    curl_close($ch);
}


add_action( 'wpcf7_before_send_mail', function ($cf7) {

    // get sharpspring codes
    $forms = get_field('contact_forms','option');

    // if codes exist, proceed
    if ($forms):

        // get default URI
        $baseURI = get_field('sharpspring_base_uri','option');
        $endpoint = null;

        // loop through codes, look for match
        foreach ($forms as $form){

            // if the form submitted is a match
            if ($_POST['_wpcf7'] == $form['contact_form_id'])
            {

                // overwrite base uri if included
                if ($form['base_uri'])
                {
                    $baseURI = $form['base_uri'];
                }

                // store the endpoint
                $endpoint = $form['endpoint'];
            }
        }

        // if endpoint was passed, submit form
        if ($endpoint){
            submitToSharpSpring($_POST, $baseURI, $endpoint);
        }

    endif;

});