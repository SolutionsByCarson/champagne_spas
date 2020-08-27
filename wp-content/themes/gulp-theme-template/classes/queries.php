<?php
/** QUERIES.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: Custom query classes for high performance + simplicity
**/


// Query functions
function cim_query($type = 'post', $count = 19, $order = 'date', $category = null, $exclude = null, $offset = 0)
{

    // Set the simple query stuff
    $args = array(
        'post_status' => 'publish',
        'posts_per_page' => $count,
    );

    // Set Post Type
    switch ($type) {

        case 'post':
        case 'blogs':
        case 'articles':
        case 'article':
        case 'blog':
        {
            $args['post_type'] = 'post';
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'cim_blog_type',
                    'field' => 'slug',
                    'terms' => 'gear-software',
                    'operator' => 'NOT IN'
                )
            );
            break;
        }

        case 'gs':
        case 'gear':
        case 'gear-software':
        {
            $args['post_type'] = 'post';
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'cim_blog_type',
                    'field' => 'slug',
                    'terms' => 'gear-software',
                )
            );
            break;
        }

        case 'career':
        case 'careers':
        {
            $args['post_type'] = 'page';
            $args['meta_query'] = array(
                'template_clause' => array(
                    'key' => '_wp_page_template',
                    'value' => 'template-career-single.php',
                    'compare' => '=',
                ),
            );
            break;
        }

        case 'career-category':
        case 'career-categories':
        {
            $args['post_type'] = 'page';
            $args['meta_query'] = array(
                'template_clause' => array(
                    'key' => '_wp_page_template',
                    'value' => 'template-career-category.php',
                    'compare' => '=',
                ),
            );
            break;
        }
    }

    // Set Query Order
    if ($order == 'date'):
        $args['orderby'] = 'post_date';
        $args['order'] = 'DESC';
    elseif ($order == 'title'):
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
    else:
        $args['meta_key'] = 'trend_period_views';
        $args['orderby'] = array('meta_value_num' => 'DESC');
    endif;

    // Set Category
    if ($category) {
        $args['category'] = $category;
    }

    // Exclude current post
    if (is_single() || is_singular('schools')) {
        if ($exclude) {
            if (substr($exclude, -1) == ',') {
                $args['exclude'] = $exclude . get_the_ID();
            } else {
                $args['exclude'] = $exclude . ',' . get_the_ID();
            }
        } else {
            $args['exclude'] = get_the_ID();
        }
    }


    // Offset Query
    if ($offset != 0) {
        $args['offset'] = $offset;
    }

    return get_posts($args);

}
