<?php
/** BREADCRUMB.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: SBC breadcrumb
// ----- Credit: https://github.com/mobilejazz/MJ-WP-Breadcrumb
// ----- License: Apache License 2.0 https://github.com/mobilejazz/MJ-WP-Breadcrumb/blob/master/LICENSE
 **/

// Breadcrumb
if ( ! function_exists( 'mj_wp_breadcrumb' ) ) {
    function mj_wp_breadcrumb ( $list_style = 'ol', $list_id = 'breadcrumb', $list_class = 'breadcrumb', $active_class = 'active', $aria_active = 'aria-current="page"', $echo = true ) {

        // Get text domain for translations
        $theme = wp_get_theme();
        $text_domain =  $theme->get( 'TextDomain' );
        global $prefix;
        // Open list
        $breadcrumb = '<nav aria-label="breadcrumb" class="mb-3 mb-lg-5"><' . $list_style . ' id="' . $list_id . '" class="' . $list_class . '">';


        // Front page
        if ( is_front_page() ) {
            $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . get_bloginfo( 'name' ). '</span></li>';
        } else {
            $breadcrumb .= '<li class="breadcrumb-item home"><a href="' . home_url() . '"><i class="fas fa-home"></i></a></li>';
        }

// SCHOOLS START //
        // Schools Archive Page
        if ( is_post_type_archive('schools') ):

            // Add Music Schools Current
            $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>Music Schools</span></li>';

        // If Other Schools Page
        elseif (
            is_page_template('template-area-of-study.php') ||
            is_page_template('template-setting.php') ||
            is_page_template('template-state-schools.php') ||
            is_singular('schools')
        ):
            // Add Music Schools Home
            $breadcrumb .= '<li class="breadcrumb-item"><span><a href="/music-schools/">Music Schools</a></span></li>';

            // If AOS Page
            if ( is_page_template('template-area-of-study.php') ):

                // Get current AOS and add as active Item:
                $curAOS = get_field('template_aos', get_the_ID());
                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . $curAOS->name  . '</span></li>';

            endif;

            // If Setting Page
            if ( is_page_template('template-setting.php') ):

                // Get current Setting and add as active Item:
                $curSET = get_field('template_setting', get_the_ID());
                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . $curSET->name  . '</span></li>';

            endif;

            // If Location Page
            if ( is_page_template('template-state-schools.php') ):

                // Get locations and parents'
                $curLoc = get_field('template_state');

                if ($curLoc->parent !== 0){
                    $curPar = get_term( $curLoc->parent, 'state_province');
                }

                if ($curPar->parent !== 0){
                    $curAnc = get_term( $curPar->parent, 'state_province');
                }

                if ($curAnc->parent !== 0){
                    $curAnc2 = get_term( $curAnc->parent, 'state_province');
                }


                if ($curAnc2->name):
                    if ( get_field('short_name', $curAnc2) ): $anc2Name = get_field('short_name', $curAnc2);
                    else: $anc2Name = $curAn2c->name; endif;
                    if ( get_field('custom_landing', $curAnc2) ): $anc2Link = get_field('custom_landing', $curAnc2);
                    else: $anc2Link = "/schools/?fwp_state_province=" . $curAnc2->name; endif;

                    $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . $anc2Link . '">' . $anc2Name . '</a></span></li>';
                endif;

                if ($curAnc->name):
                    if ( get_field('short_name', $curAnc) ): $ancName = get_field('short_name', $curAnc);
                    else: $ancName = $curAnc->name; endif;
                    if ( get_field('custom_landing', $curAnc) ): $ancLink = get_field('custom_landing', $curAnc);
                    else: $ancLink = "/schools/?fwp_state_province=" . $curAnc->name; endif;

                    $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . $ancLink . '">' . $ancName . '</a></span></li>';
                endif;

                if ($curPar->name):
                    if ( get_field('short_name', $curPar) ): $parName = get_field('short_name', $curPar);
                    else: $parName = $curPar->name; endif;
                    if ( get_field('custom_landing', $curPar) ): $parLink = get_field('custom_landing', $curPar);
                    else: $parLink = "/schools/?fwp_state_province=" . $curPar->name; endif;

                    $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . $parLink . '">' . $parName . '</a></span></li>';
                endif;

                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . $curLoc->name  . '</span></li>';

            endif;


            // If Single Schools Page
            if ( is_singular('schools') ):

                // Get locations and parents'
                $state = get_field('sch_location_group_sch_state', get_the_ID());
                $country = get_field('sch_location_group_sch_country', get_the_ID());

                if ($country->name):
                    if ( get_field('short_name', $country) ): $countryName = get_field('short_name', $country);
                    else: $countryName = $country->name; endif;
                    if ( get_field('custom_landing', $country) ): $countryLink = get_field('custom_landing', $country);
                    else: $countryLink = "/schools/?fwp_state_province=" . $country->name; endif;

                    $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . $countryLink . '">' . $countryName . '</a></span></li>';
                endif;

                if ($state->name):
                    if ( get_field('short_name', $curAnc) ): $stateName = get_field('short_name', $state);
                    else: $stateName = $state->name; endif;
                    if ( get_field('custom_landing', $state) ): $stateLink = get_field('custom_landing', $state);
                    else: $stateLink = "/schools/?fwp_state_province=" . $state->name; endif;

                    $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . $stateLink . '">' . $stateName . '</a></span></li>';
                endif;

                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . clean_title(get_the_title())  . '</span></li>';

            endif;

// NOT SCHOOLS //
        else:


            // Blog archive
            if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
                $blog_page_id = get_option( 'page_for_posts' );
                if ( is_home() ) {
                    $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . clean_title(get_the_title( $blog_page_id ))  . '</span></li>';
                } else if ( is_category() || is_tag() || is_author() || is_date() ) {
                    if ( $_GET['blog-type'] == 'gs' ):
                        $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_field('gear_software_page','option') . '">Gear & Software</a></span></li>';
                    else:
                        $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_permalink( $blog_page_id ) . '">' . clean_title(get_the_title( $blog_page_id ))  . '</a></span></li>';
                    endif;
                } else if ( is_singular( 'post' ) ){
                    if ( has_term('gear-software','cim_blog_type') ){
                        $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_field('gear_software_page','option') . '">Gear & Software</a></span></li>';
                    } else {
                        $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_permalink( $blog_page_id ) . '">' . clean_title(get_the_title( $blog_page_id ))  . '</a></span></li>';
                    }
                }
            }

            // Author Page
            if( is_author()){
                $author_link = get_field('authors_page_link', 'option');
                $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . $author_link . '">Authors</a></span></li>';
                //            $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>';
                //            $breadcrumb .= get_the_author_meta('display_name', get_queried_object_id());
                //            $breadcrumb .= '</span></li>';
            }

            // Category, tag, author and date archives
            if ( is_archive() && ! is_tax() && ! is_post_type_archive() ) {
                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>';
                // Title of archive
                if ( is_category() ) {
                    $breadcrumb .= single_cat_title( '', false );
                } else if ( is_tag() ) {
                    $breadcrumb .= single_tag_title( '', false );
                } else if ( is_author() ) {
                    $breadcrumb .= get_the_author_meta('display_name', get_queried_object_id());
                } else if ( is_date() ) {
                    if ( is_day() ) {
                        $breadcrumb .= get_the_time( 'F j, Y' );
                    } else if ( is_month() ) {
                        $breadcrumb .= get_the_time( 'F, Y' );
                    } else if ( is_year() ) {
                        $breadcrumb .= get_the_time( 'Y' );
                    }
                }
                $breadcrumb .= '</span></li>';
            }

            // Posts
            if ( is_singular( 'post' )) {
                // Post categories
                $cat_id = get_primary_cat();
                $cat_link = get_term_link($cat_id);
                $cat_name = get_category($cat_id)->name;

                if (has_term('gear-software','cim_blog_type')){
                    $cat_link = $cat_link . '?blog-type=gs';
                }

                if ( $cat_link ) {
                    $breadcrumb .= '<li class="breadcrumb-item"><a href="' . $cat_link . '"><span>' . clean_title($cat_name) . '</span></a></li>';
                }
            }

            // Pages
            if ( is_page() && ! is_front_page() ) {
                $post = get_post( get_the_ID() );
                // Page parents
                if ( $post->post_parent ) {
                    $parent_id  = $post->post_parent;
                    $crumbs = array();
                    while ( $parent_id ) {
                        $page = get_post( $parent_id );
                        $crumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . clean_title(get_the_title( $page->ID )) . '</a>';
                        $parent_id  = $page->post_parent;
                    }
                    $crumbs = array_reverse( $crumbs );
                    foreach ( $crumbs as $crumb ) {
                        $breadcrumb .= '<li class="breadcrumb-item"><span>' . $crumb . '</span></li>';
                    }
                }
                // Page title
                $breadcrumb .=  '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . clean_title(get_the_title()) . '</span></li>';
            }
            // Attachments
            if ( is_attachment() ) {
                // Attachment parent
                $post = get_post( get_the_ID() );
                if ( $post->post_parent ) {
                    $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_permalink( $post->post_parent ) . '">' . clean_title(get_the_title( $post->post_parent )) . '</a></span></li>';
                }
                // Attachment title
                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . clean_title(get_the_title()) . '</span></li>';
            }
            // Search
            if ( is_search() ) {
                $srchval = htmlspecialchars($_GET["s"]) ;
                if ( ! empty( $post ) ) {
                    $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_permalink( $post->post_parent ) . '">' . __( 'Search', $text_domain ) . '</a></span></li>';
                }
                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . $srchval . '</span></li>';
            }
            // 404
            if ( is_404() ) {
                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . __( '404', $text_domain ) . '</span></li>';
            }
            // Custom Post Type Archive
            if ( is_post_type_archive() ) {
                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . clean_title(post_type_archive_title( '', false )) . '</span></li>';
            }
            // Custom Taxonomies
            if ( is_tax() ) {
                // Get the post types the taxonomy is attached to
                $current_term = get_queried_object();
                $attached_to = array();
                $post_types = get_post_types();
                foreach ( $post_types as $post_type ) {
                    $taxonomies = get_object_taxonomies( $post_type );
                    if ( in_array( $current_term->taxonomy, $taxonomies ) ) {
                        $attached_to[] = $post_type;
                    }
                }
                // Post type archive link
                $output = false;
                foreach ( $attached_to as $post_type ) {
                    $cpt_obj = get_post_type_object( $post_type );
                    if ( ! $output && get_post_type_archive_link( $cpt_obj->name ) ) {
                        $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_post_type_archive_link( $cpt_obj->name ) . '">' . $cpt_obj->labels->name . '</a></span></li>';
                        $output = true;
                    }
                }
                // Term title
                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . single_term_title( '', false ) . '</span></li>';
            }
            // Custom Post Types
            if ( is_single() && get_post_type() != 'post' && get_post_type() != 'attachment' ) {
                $cpt_obj = get_post_type_object( get_post_type() );
                // Is cpt hierarchical like pages or posts?
                if ( is_post_type_hierarchical( $cpt_obj->name ) ) {
                    // Like pages
                    // Cpt archive
                    if ( get_post_type_archive_link( $cpt_obj->name ) ) {
                        $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_post_type_archive_link( $cpt_obj->name ) . '">' . $cpt_obj->labels->name . '</a></span></li>';
                    }
                    // Cpt parents
                    $post = get_post( get_the_ID() );
                    if ( $post->post_parent ) {
                        $parent_id  = $post->post_parent;
                        $crumbs = array();
                        while ( $parent_id ) {
                            $page = get_page( $parent_id );
                            $crumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
                            $parent_id  = $page->post_parent;
                        }
                        $crumbs = array_reverse( $crumbs );
                        foreach ( $crumbs as $crumb ) {
                            $breadcrumb .= '<li class="breadcrumb-item"><span>' . $crumb . '</span></li>';
                        }
                    }
                } else {
                    // Like posts
                    // Cpt archive
                    if ( get_post_type_archive_link( $cpt_obj->name ) ) {
                        $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_post_type_archive_link( $cpt_obj->name ) . '">' . $cpt_obj->labels->name . '</a></span></li>';
                    }
                    // Get cpt taxonomies
                    $cpt_taxes = get_object_taxonomies( $cpt_obj->name );
                    if ( $cpt_taxes && is_taxonomy_hierarchical( $cpt_taxes[0] ) ) {
                        // Other taxes attached to the cpt could be hierachical, so need to look into that.
                        $cpt_terms = get_the_terms( get_the_ID(), $cpt_taxes[0] );
                        if ( is_array( $cpt_terms ) ) {
                            $output = false;
                            foreach( $cpt_terms as $cpt_term ) {
                                if ( ! $output ) {
                                    $breadcrumb .= '<li class="breadcrumb-item"><span><a href="' . get_term_link( $cpt_term->name, $cpt_taxes[0] ) . '">' . $cpt_term->name . '</a></span></li>';
                                    $output = true;
                                }
                            }
                        }
                    }
                }
                // Cpt title
                $breadcrumb .= '<li class="breadcrumb-item ' . $active_class . '"' . $aria_active . '><span>' . clean_title(get_the_title()) . '</span></li>';
            }
        endif;

        // Close list
        $breadcrumb .= '</' . $list_style . '></nav>';
        // Ouput
        if ( $echo ) {
            echo $breadcrumb;
        } else {
            return $breadcrumb;
        }
    }
}
