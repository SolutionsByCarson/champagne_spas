<?php
/** SITE-SEARCH.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: proprietary search bar built by Solutions By Carson, searches pages, posts, and custom post types
 **/

/******* NEEDS OPTIMIZATION --- NOT READY TO IMPLEMENT ************/



// -----------------------------------------------------
// -------------- Database Indexing Functions
// -----------------------------------------------------
// Add posts and alternate titles to database
function srch_get_posts() {

    // Build query for posts
    $query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'cache_results'     => false,
        'no_found_rows'     => true,
//        'meta_key'		=> 'exclude_from_search',
//        'meta_value'	=> '0',
    ));
    $myposts = (array) $query->posts;

    // Loop through posts
    foreach ( $myposts as $mypost ) {
        $post_id = $mypost->ID;
        $alt_titles = '';
        $srch_cat = 'post';
        $exclude = get_field('exclude_from_search', $post_id);

        // If exclude is not marked:
        if( $exclude == '0' || $exclude == ''):

            //Values for database
            $params = array (
                'srch_title' => get_the_title($post_id),
                'srch_post_type' => get_post_type($post_id),
                'srch_link' => get_the_permalink($post_id),
                'srch_cat' => $srch_cat,
                'srch_post_id' => $post_id,
                'srch_view_count' => (int) get_field('trend_period_views', $post_id),
                'srch_alt_title' => $alt_titles,
                'srch_label' => 'blog article'
            );

            // Pass to db
            srch_insert_row($params);

        endif;
    }

}



// Add category pages to database
function srch_get_cat_pages() {

    // Build query for posts
    $categories = get_categories(array(
        'hide_empty' => 1,
//        'meta_key'		=> 'exclude_from_search',
//        'meta_value'	=> '0',
    ));


    // Loop through posts
    foreach ( $categories as $category ) {
        $cat_id = $category->term_id;
        $acf_cat_id = 'category_' . $cat_id;
        $cat_name = $category->name;
        $cat_link = '';
        $cat_link = get_category_link($cat_id);
        $exclude = get_field('exclude_from_search');

        if( $exclude = '0' || $exclude == ''):

            //Values for database
            $params = array (
                'srch_title' => $cat_name,
                'srch_post_type' => 'page',
                'srch_link' => $cat_link,
                'srch_cat' => 'post',
                'srch_post_id' => $cat_id,
                'srch_view_count' => (int) get_field('trend_period_views', $acf_cat_id),
                'srch_alt_title' => '',
                'srch_label' => 'blog topic'
            );

            // Pass to db
            srch_insert_row($params);

        endif;
    }

}


// Add pages and alternate titles to database
function srch_get_pages() {

    // Build query for posts
    $query = new WP_Query(array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'cache_results'     => false,
        'no_found_rows'     => true,
//        'meta_key'		=> 'exclude_from_search',
//        'meta_value'	=> '0',
    ));
    $mypages = (array) $query->posts;


    // Loop through posts
    foreach ( $mypages as $mypage ) {
        $post_id = $mypage->ID;
        $label = '';
        $alt_list = '';
        $srch_cat = '';
        $exclude = get_field('exclude_from_search', $post_id);


        // if page is not marked to be excluded, add to search:
        if( $exclude == '0' || $exclude == ''):

            //Page label based on page template
            $template_file = get_post_meta( $post_id, '_wp_page_template', TRUE );
            if ($template_file == 'template-career-single.php'):
                $label = 'career profile';//generate alternate titles list
                $srch_cat = 'career';
                if( have_rows('alternate_titles',  $post_id) ):
                    while( have_rows('alternate_titles',  $post_id) ): the_row();
                        $alt_titles = get_sub_field('title');
                        $alt_list .= $alt_titles . ", ";
                    endwhile;
                endif;
            elseif ($template_file == 'template-career-landing.php'):
                $label = 'page';
                $srch_cat = 'career';
            elseif ($template_file == 'template-career-category.php'):
                $label = 'career category';
                $srch_cat = 'career';
            elseif ($template_file == 'template-career-category-index.php'):
                $label = 'career category index';
                $srch_cat = 'career';
            elseif ($template_file == 'template-blog-category-index.php'):
                $label = 'blog topic index';
                $srch_cat = 'blog';
            elseif ($template_file == 'template-music-schools-landing.php'):
                $label = 'schools page';
                $srch_cat = 'page';
            elseif ($template_file == 'template-setting.php'):
                $label = 'schools page';
                $srch_cat = 'page';
            elseif ($template_file == 'template-state-schools.php'):
                $label = 'schools page';
                $srch_cat = 'page';
            elseif ($template_file == 'template-area-of-study.php'):
                $label = 'schools page';
                $srch_cat = 'page';
            elseif ($template_file == 'category.php'):
                $label = 'blog topic';
            else:
                $label = 'page';
                $srch_cat = 'page';
            endif;

            $view_count = (int) get_field('trend_period_views', $post_id);

            if ($view_count == '' || !$view_count):
                $view_count = 0;
            endif;
            //Values for database
            $params = array (
                'srch_title' => clean_title(get_the_title($post_id)),
                'srch_post_type' => get_post_type($post_id),
                'srch_link' => get_the_permalink($post_id),
                'srch_cat' => $srch_cat,
                'srch_post_id' => $post_id,
                'srch_view_count' => $view_count,
                'srch_alt_title' => $alt_list,
                'srch_label' => $label
            );

            // Pass to db
            srch_insert_row($params);

        endif;
    }
}




// Combine the search indexing functions

function srch_index () {

    //check if database is installed
//    srch_install();

    // Clear the search db
    srch_clear_table();

    // Bypass the PHP timeout
    ini_set( 'max_execution_time', 0 );

    // Gather all search options
    srch_get_posts();
    srch_get_pages();
    srch_get_cat_pages();
//    srch_get_custom();
//    srch_get_aos();
//    srch_get_locations();

    // Sort the DB
//    srch_sort_table();
}



// -----------------------------------------------------
// -------------- Database Utility Functions
// -----------------------------------------------------

// Install/setup the search db
function srch_install () {

    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $table_name = $wpdb->prefix . "sbc_srch";
    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );

    if ( ! $wpdb->get_var( $query ) == $table_name ) {
        $sql = "
        CREATE TABLE IF NOT EXISTS $table_name (
                id INTEGER NOT NULL AUTO_INCREMENT,
                srch_title VARCHAR(99),
                srch_post_type VARCHAR(99),
                srch_link VARCHAR(199),
                srch_cat VARCHAR(99),
                srch_post_id VARCHAR(99),
                srch_view_count INT,
                srch_alt_title VARCHAR(199),
                srch_label VARCHAR(99),
                PRIMARY KEY  (id)
        ) DEFAULT CHARSET=utf8";
        dbDelta($sql);
    }
}


// Insert row into search db
function srch_insert_row( $params ) {
    global $wpdb;
    $wpdb->insert('wp_sbc_srch',$params);
}



// Clear the search db
function srch_clear_table(){
    global $wpdb;
    $wpdb->query( "TRUNCATE TABLE wp_sbc_srch" );
}



// Uninstall/remove the search db
function srch_uninstall(){
    global $wpdb;
    $wpdb->query( "DROP TABLE IF EXISTS wp_sbc_srch" );
}




// -----------------------------------------------------
// -------------- Function Events/Triggers
// -----------------------------------------------------


// Activation Hooks - Install the DB
//register_activation_hook( __FILE__, 'srch_install' );
add_action('init', 'srch_install');
add_action('save_post', 'srch_index');

// Indexing Hooks - When to Gather Search Options
add_action('after_switch_theme', 'srch_index');         //--- Index on theme switch

// Index database every hour
add_action( 'search_cron_hook', 'srch_index' );
if ( ! wp_next_scheduled( 'search_cron_hook' ) ) {
    wp_schedule_event( time(), 'hourly', 'search_cron_hook' );
}


add_action('switch_theme', 'srch_clear_table');
add_action('switch_theme', 'srch_uninstall');



// -----------------------------------------------------
// -------------- Global Search Shortcode
// -----------------------------------------------------


// Add search plugin shortcode
add_action('init', 'global_srch_shortcode_init');

function global_srch_shortcode_init() {

    // Header global shortcode function
    function header_srch_shortcode($atts = [], $content = null) {
        $global_search_prompt = get_field('global_search_prompt', 'option');
        ?>
        <form class="header-search-form" method="get" autocomplete="off" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="search-helper" id="header-search-helper">
                <input type="text" autocomplete="off" class="search-bar" name="s" id="header-search-input" aria-label="<?php echo $global_search_prompt ?>" placeholder="<?php echo $global_search_prompt ?>" value="<?php echo get_search_query(); ?>" />
                <button class="search-submit" type="submit" name="submit" id="search-submit" aria-label="Search Whole Site"><i class="fas fa-search"></i></button>
            </div>
            <div class="search-close">
                <span class="close-search" aria-label="toggle site search"><i class="fas fa-times" style="margin-right: .25rem;"></i>  Close</span>
            </div>
        </form>
        <?php
    }
    add_shortcode( 'header_srch', 'header_srch_shortcode' );


    // Body global shortcode function
    function global_srch_shortcode( $atts = [], $content = null ) {
        $global_search_prompt = get_field( 'global_search_prompt', 'option' );
        ?>
        <form method="get"  autocomplete="off" class="body-search-form" id="global-body-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="search-helper" id="body-search-helper">
                <input type="text" autocomplete="off" class="search-bar body-search-input" id="body-search-input" name="s" aria-label="<?php echo $global_search_prompt ?>" placeholder="<?php echo $global_search_prompt ?>" value="<?php echo get_search_query(); ?>" />
                <button class="search-submit" type="submit" name="submit" id="search-submit" aria-label="Search Whole Site"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <?php
    }
    add_shortcode( 'global_srch', 'global_srch_shortcode' );


    // Body career shortcode function
    function career_srch_shortcode($atts = [], $content = null) {
        $career_search_prompt = get_field('careers_search_prompt', 'option'); ?>
        <form action="" autocomplete="off" class="body-search-form" id="career-body-search">
            <div class="search-helper" id="body-search-helper">
                <input type="hidden" autocomplete="off" class="category" name="category_name" value="">
                <input type="hidden" autocomplete="off" class="type" name="post_type" value="page">
                <input type="text" autocomplete="off" class="search-bar body-search-bar" id="body-search-input" category="" placeholder="<?php echo $career_search_prompt ?>" aria-label="<?php echo $career_search_prompt ?>">
                <button class="search-submit" type="submit" id="search-submit" aria-label="Start Careers"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <?php
//        add_action('wp_footer', 'global_srch_results');
    }
    add_shortcode('career_srch', 'career_srch_shortcode');

    // Body blog shortcode function
    function blog_srch_shortcode($atts = [], $content = null) {
        $blog_search_prompt = get_field('blog_search_prompt', 'option'); ?>
        <form action="" autocomplete="off" class="body-search-form" id="blog-body-search">
            <div class="search-helper" id="body-search-helper">
                <input type="hidden" autocomplete="off" class="category" name="category_name" value="">
                <input type="hidden" autocomplete="off" class="type" name="post_type" value="post">
                <input type="text" autocomplete="off" class="search-bar body-search-input" id="body-search-input" category="" placeholder="<?php echo $blog_search_prompt ?>" aria-label="<?php echo $blog_search_prompt ?>">
                <button class="search-submit" type="submit" id="search-submit" aria-label="Search Articles"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <?php
//        add_action('wp_footer', 'global_srch_results');
    }
    add_shortcode('blog_srch', 'blog_srch_shortcode');

}

// Enqueue JS and localize AJAX
wp_enqueue_script('global_srch_suggestions', get_template_directory_uri() . '/dist/js/search-min.js', array(), '1.0.0', true);
wp_localize_script('global_srch_suggestions', 'global_suggestions', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
));




// -----------------------------------------------------
// -------------- Global Search AJAX
// -----------------------------------------------------


// Initialize Global Search Suggestions AJAX
add_action('init','initialize_global_srch_suggestions');
function initialize_global_srch_suggestions(){
    add_action( 'wp_ajax_global_srch_results', 'global_srch_results' );
    add_action( 'wp_ajax_nopriv_global_srch_results', 'global_srch_results' );
}

// Get Global Search Results
function global_srch_results(){

    global $wpdb;

    // construct suggestions list
    $suggestions = '';
    $keyword = $_POST['keyword'];               // keyword used for SQL query match
    $type = $_POST['type'];                     // search type declared in search bar meta
    $cacheArray = $_POST['idArray'];            // array of ID's for previously searched words
    $cache = implode( ',', $cacheArray);  // convert array to string



    if($keyword) {
        // category specific search query
        if ($type != '') {
            $result = $wpdb->get_results("SELECT * FROM wp_sbc_srch WHERE srch_title LIKE'%" . $keyword . "%' AND srch_cat = '" . $type . "' AND id NOT IN (" . $cache . ") ORDER BY srch_view_count DESC");
        }
        // global search query
        else{
            $result = $wpdb->get_results("SELECT * FROM wp_sbc_srch WHERE srch_title LIKE'%" . $keyword . "%' AND id NOT IN (" . $cache . ") ORDER BY srch_view_count DESC");
        }
        if (!empty($result)) {
            foreach ($result as $item) {
                $suggestions .=
                    '<li class="result-item new" tabindex="1" id="' . $item->id . '" data-target="' . $item->srch_link . '">
                        <a href="' . $item->srch_link . '">
                    <span class="label result" data-original="' . $item->srch_title . '">' . $item->srch_title . '</span>
                    <span class="type" data-type="' . $item->srch_cat . '">' . $item->srch_label . '</span>
                    </a>
                </li>';
            }
        }
//            $suggestions .= '<li>' . $type . '</li>';
    } else {
//            $suggestions .= '<li>keyword not working</li>';
//            $suggestions .= '<li>' . $keyword . ':::' . $type . '</li>';
    }
    exit(json_encode($suggestions));
}


