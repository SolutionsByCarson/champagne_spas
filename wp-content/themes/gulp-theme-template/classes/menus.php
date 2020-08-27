<?php
/** MENUS.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: declare theme menus, custom walkers, and functions
**/


// Add "menus" tab under appearance
function register_my_menus() {
    register_nav_menus(
        array(
            'top-nav' => __( 'Top Nav' ),
            'footer-nav' => __( 'Footer Nav' )
        )
    );
}
add_action( 'init', 'register_my_menus' );



class SBC_Walker extends Walker_Nav_Menu
{


    // START BRANCH/LVL
    function start_lvl( &$output, $depth = 0, $args = array() )
    {
    }

    // CLOSE BRANCH/LVL
    function end_lvl( &$output, $depth = 0, $args = array() )
    {
    }

    // START ELEMENT
    function start_el(&$output, $item, $depth = 0, $args=array(), $id = 0)
    {
        // prepare menu-item vars
        $title = $item->title;
        $url = $item->url;

        // condition vars
        $has_children = in_array('menu-item-has-children',$item->classes);
        $is_active = in_array('current_page_item',$item->classes);
        $is_child = $item->menu_item_parent==0?false:true;
        $is_cta = in_array('cta', $item->classes);

        // if top level menu item
        if ( !$is_child ):

            // build <li> class
            $li_class = concat(array(
                'nav-item',
                $is_active?'active':null,
                $has_children?'dropdown':null,
                $is_cta?'nav-cta':null,
            ),' ');

            // close previous parent <li>
            if ($parent_label){
                $output .= '</div></li>';
                $parent_label = '';
            }

            // open <li>
            $output .= '<li class="' . $li_class . '">';

            // print link + title
            $output .= '<a class="nav-link" href="' . $url . '">' . $title . '</a>';

            // open child
            if ($has_children){
                $parent_label = clean_ID($title);
                $output .= '<i class="fas fa-caret-down dropdown-icon" id="' . $parent_label . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>';
                $output .= '<div class="dropdown-menu" aria-labelledby="' . $parent_label . '">';

                // if no children, close <li>
            } else {
                $output .= '</li>';
            }

        // if child level menu item
        else:

            // build <a> class
            $a_class = concat(array(
                'dropdown-item',
                $is_active?'active':null,
            ));

            // create <a>
            $output .= '<a class="' . $a_class .'" href="' . $url .'">' . $title . '</a>';

        endif;
    }

    // CLOSE ELEMENT
    function end_el(&$output, $item, $depth = 0, $args=array(), $id = 0)
    {
    }

}