<?php
/** STRUCTURED-DATA.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: proper schema markup for google
 **/

function structuredData(){

    global $post;
    $id = get_the_ID();
    $schema = "";
    $PL_schema = get_field('PL_schema', $id);

    // Determine "music" or "film"
    $domain = $_SERVER['HTTP_HOST'];
    if( $domain == 'www.careersinfilm.com'):
        $industry = 'Film';
    elseif( $domain == 'www.careersinmusic.com' || $domain == 'www.careersinmusic.co.uk' ):
        $industry = 'Music';
    else:
        $industry = 'LocalHost';
    endif;

    // state of school
    $state = get_field('sch_location_group_sch_state');
    if ( $state ) {
        $state = esc_html( $state->name );
    } else {
        $state = '';
    }



    //get post category
    $post_cats = get_the_category($id);
    if ( count( $post_cats ) > 0 ) {
        $cat_name = $post_cats[0]->name;
    } else {
        $cat_name = '';
    }
    $cat_abrv = str_replace(' ', '-', $cat_name);

// use preloaded schema
//    if ($PL_schema):
//
//        echo $PL_schema;

// construct schema
//    else:

    // Get Schema Vars
    $siteurl = get_site_url();
    $sitename = get_bloginfo('name');
    $sameas = get_field('schema_sameas','option');
    $currurl = get_the_permalink();
    $currname = get_post_meta($id, '_aioseop_title', true);
    if (!$currname){
        $currname = get_the_title();
    }
    $description = get_post_meta( $id, '_aioseop_description', true);
    if (!$description){
        $description = get_the_excerpt();
    }
    $datePublished = mysql2date( DATE_W3C, $post->post_date_gmt, false );
    $dateModified = mysql2date( DATE_W3C, $post->post_modified_gmt, false );
    $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "featured-img" );
    $logo_data = wp_get_attachment_image_src( get_field('schema_logo','option'), "schema-logo" );
    $image_alt = get_post_meta(get_post_thumbnail_id($id), '_wp_attachment_image_alt', true);

    $schema = array(
        '@context' => 'https://schema.org',
        '@graph' => array(),
    );

    // Add organization
    $schema['@graph'][] = array(
        '@type'  => 'Organization',
        '@id'    => $siteurl . '#organization',
        'url'    => $siteurl,
        'name'   => $sitename,
        'sameas' => array( $sameas ),
        'logo'   => array(
            '@type'  =>  'ImageObject',
            '@id'    =>  $siteurl . '#logo',
            'url'    =>  $logo_data[0],
            'width'  =>  $logo_data[1],
            'height' =>  $logo_data[2],
        ),
    );



    // Add Website
    $schema['@graph'][] = array(
        '@type'     =>  'Website',
        '@id'       =>  $siteurl . '#website',
        'url'       =>  $siteurl,
        'name'      =>  $sitename,
        'publisher' =>  array(
            '@id' => $siteurl . '#organization',
        ),
    );


    // Add Page content
    $web_page_schema = array(
        '@type'      => 'WebPage',
        '@id'        => $currurl . '#webpage',
        'url'        => $currurl,
        'inLanguage' => 'en-US',
        'name'       => $currname,
        'isPartOf'   => array(
            '@id' => $siteurl . '#website',
        ),
        'image' => array(
            '@type'   => 'ImageObject',
            '@id'     => $currurl . '#primaryimage',
            'url'     => $image_data[0],
            'width'   => $image_data[1],
            'height'  => $image_data[2],
            'caption' => $image_alt,
        ),
        'primaryImageOfPage' => array(
            '@id' => $currurl . '#primaryimage',
        ),
        'datePublished' => $datePublished,
        'dateModified'  => $dateModified,
        'description'   => $description,
    );

    if ( is_page_template('template-career-single.php' ) ):
        // Get source vars
        $sourcename = get_field( 'source_name', $id, false );
        $sourcebio = get_field( 'source_bio', $id, false );

        $web_page_schema['author'] = array(
            '@type' => 'Person',
            'name'  =>  $sourcename,
            'description' => $sourcebio,
        );
    endif;

    $web_page_schema['publisher'] = array(
        '@id' =>$siteurl . '#organization',
    );

    $schema['@graph'][] = $web_page_schema;



    // Add Post content
    if ( is_single() ) :

        // Get author vars
        $author = $post->post_author;
        $authorname = get_the_author_meta( 'display_name', $author );
        $authorlink = get_author_posts_url( $author );
        $authorbio = get_the_author_meta( 'description', $author );

        $schema['@graph'][] = array(
            '@type' => 'BlogPosting',
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id' => $currurl . '#webpage',
            ),
            '@id'        => $currurl . '#blogpost',
            'url'        => $currurl,
            'inLanguage' => 'en-US',
            'name'       => $currname,
            'headline'   => $currname,
            'author'     => array(
                '@type' => 'Person',
                'name' => $authorname,
                'description' => $authorbio,
                'url' => $authorlink,
            ),
            'isPartOf'   => array(
                '@id' => $siteurl . '#website',
            ),
            'publisher'  => array(
                '@id' => $siteurl . '#organization',
            ),
            'image'      => array(
                '@type' => 'ImageObject',
                '@id' => $currurl . '#primaryimage',
                'url' => $image_data[0],
                'width' => $image_data[1],
                'height' => $image_data[2],
                'caption' => $image_alt,
            ),
            'datePublished' => $datePublished,
            'dateModified'  => $dateModified,
            'description'   => $description,
        );
    endif;



    // FAQ Schema
    if ( have_rows( 'faq', $id ) ) :
        $faq_schema = array(
            '@type' => 'FAQPage',
            'mainEntity' => array(),
        );
        while ( have_rows('faq', $id) ) : the_row();
            $faq_schema['mainEntity'][] = array(
                '@type' => 'Question',
                'name' => get_sub_field( 'question' ),
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text'  => get_sub_field( 'answer', false ),
                ),
            );
        endwhile;
    endif;



    // Breadcrumb Schema
    $breadcrumbs_schema = array(
        '@type' => 'BreadcrumbList',
        'itemListElement' => array(),
    );
    $breadcrumbs_schema['itemListElement'][] = array(
        '@type' => 'ListItem',
        'position' => 1,
        'name' => get_bloginfo( 'name' ),
        'item' => get_home_url(),
    );

    if ( is_home() || is_archive() ) :
        $breadcrumbs_schema['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Blog',
            'item' => get_permalink( get_option( 'page_for_posts' ) ),
        );

    // Gear and Software
    elseif ( is_page_template( 'template-gear-software' ) ) :
        $breadcrumbs_schema['itemListElement'][] = array(
            array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Gear & Software',
                'item' => get_permalink( get_option( 'gear_software_page' ) ),
            ),
            array(
                '@type' => 'ListItem',
                'position' => 3,
                'name' => get_the_title( $id ),
                'item' => get_permalink( $id ),
            ),
        );

    // Career Single
    elseif ( is_page_template( 'template-career-single.php' ) ) :
        $breadcrumbs_schema['itemListElement'][] = array(
            array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $industry . ' Careers',
                'item' => get_home_url() . get_option( 'careers_page_link' ),
            ),
            array(
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $cat_name,
                'item' => get_home_url() . get_option( 'careers_page_link' ) . $cat_abrv . '/',
            ),
            array(
                '@type' => 'ListItem',
                'position' => 4,
                'name' => get_the_title( $id ),
                'item' => get_permalink( $id ),
            ),
        );

    // Schools
    elseif ( is_singular( 'schools' ) ) :
        $breadcrumbs_schema['itemListElement'][] = array(
            array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $industry,
                'item' => get_home_url() . get_field( 'schools_page', 'option' ),
            ),
            array(
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $state . ' Schools',
                'item' => get_home_url() . get_field( 'schools_page', 'option' ) . $state . '/',
            ),
            array(
                '@type' => 'ListItem',
                'position' => 4,
                'name' => get_the_title( $id ),
                'item' => get_permalink( $id ),
            ),
        );

    // Blog Single
    elseif( is_single() ):
        // *** Rich doesn't want to use categories on posts *** //
        $breadcrumbs_schema['itemListElement'][] = array(
            array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Blog',
                'item' => get_permalink( get_option( 'page_for_posts' ) ),
            ),
            array(
                '@type' => 'ListItem',
                'position' => 3,
                'name' => get_the_title( $id ),
                'item' => get_permalink( $id ),
            ),
        );

    else:
        $breadcrumbs_schema['itemListElement'][] = array(
            array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => get_the_title( $id ),
                'item' => get_permalink( $id ),
            ),
        );
    endif;

    $schema['@graph'][] = $breadcrumbs_schema;



//        // Rating Schema
//        if( is_single() || is_page_template('template-career-single.php') ):
//
//            // get rating vars
//            global $wpdb;
//            $table = $wpdb->prefix . "userratings";
//            $ratings = $wpdb->get_results("SELECT * FROM {$table} WHERE postid = {$id}", OBJECT);
//            $rating_count = count($ratings);
//            $total = 0;
//
//            if ($rating_count == 0) {
//                $average = 0;
//            } else {
//                foreach ($ratings as $rating) {
//                    $total = $total + $rating->rating;
//                }
//                $average = round(($total / $rating_count) * 2) / 2;
//
//                $schema .= ',{' .
//                    '"@context":"https://schema.org/",' .
//                    '"@type":"AggregateRating",' .
//                    '"itemReviewed":{' .
//                    '"@type":"CreativeWorkSeries",' .
//                    '"image":"' . $image_date[0] . '",' .
//                    '"name":"' . $title . '"' .
//                    '},' .
//                    '"ratingValue":"' . $average . '",' .
//                    '"bestRating":"5",' .
//                    '"ratingCount":"' . $rating_count . '"' .
//                    '}';
//            }
//        endif;



    // Turn schema data into string.
    $schema = sprintf( '<script type="application/ld+json" class="CIM-schema">%s</script>', json_encode( $schema ) );

    // echo schema and update preloaded schema
    echo $schema;

    update_field( 'PL_schema', $schema, $id );


//    endif;
}