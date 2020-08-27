<?php

function show_card_section()
{
// check if global card section is enabled?
    $enable_card_section = get_field('add_card_section');
    if ($enable_card_section):

        //standard wp query args
        $args = array(
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'post_type' => 'post',
        );

        // Loop through posts and show them using card builder function
        function show_posts($posts)
        {
            foreach ($posts as $post):
                $id = $post->ID;
                sbc_card($id);
            endforeach;
        }

        // loop through custom card
        function card_section($card_type)
        {
            if (have_rows($card_type)):
                while (have_rows($card_type)): the_row();
                    sbc_card(null, $card_type['img'], $card_type['head'], $card_type['desc'], $card_type['link']);
                endwhile;
            endif;
        }

        $card_section = get_field('_optional_card_section');
        switch ($card_section['card_type']):
            case 'recent_posts':
                $args['orderby'] = 'post_date';
                $posts = get_posts($args);
                show_posts($posts);
                break;
            case 'cat_posts':
                $args['category'] = $card_section['post_category'];
                $posts = get_posts($args);
                show_posts($posts);
                break;
            default:
                $card_repeater = $card_section['custom_cards'];
                if (have_rows($card_repeater)):
                    print_r('working');
//                    while (have_rows($card_repeater)): the_row();
//                        $card_info = get_sub_field('_card');
//                        sbc_card($card_info['img'], $card_info['head'], $card_info['desc'], $card_info['link']);
//                    endwhile;
                endif;
                break;
        endswitch;

    endif;
}

?>