<?php
/** WIDGETS.PHP
 * // ----- Version: 1.0
 * // ----- Released: 4.5.2020
 * // ----- Description: declare theme sidebar and widget areas
 **/


function sbc_widgets_init() {

    register_sidebar( array(
        'name'          => 'Left Column',
        'id'            => 'left-col',
        'before_widget' => '<div class="left-col widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="head widget-head">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => 'Center Column',
        'id'            => 'center-col',
        'before_widget' => '<div class="center-col widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="head widget-head">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => 'Right Column',
        'id'            => 'right-col',
        'before_widget' => '<div class="right-col widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="head widget-head">',
        'after_title'   => '</h4>',
    ) );

}
add_action( 'widgets_init', 'sbc_widgets_init' );

// create custom connect widget that uses ACF fields in theme options
function sbc_connect_widget() {

    class connect_widget extends WP_Widget {

        function __construct() {
            parent::__construct(

                // Base ID of your widget
                'connect_widget',

                // Widget name will appear in UI
                __('Connect', 'connect_widget_domain'),

                // Widget description
                array( 'description' => __( 'Insert your connect links with this widget', 'connect_widget_domain' ), )
            );
        }

        // Creating widget output
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );

            // echo Title if Title
            echo $args['before_widget'];
            if ( ! empty( $title ) ):
                echo $args['before_title'] . $title . $args['after_title'];
            endif;

            // echo social links if social links available in theme options
            if( have_rows('_about', 'option') ):
                while( have_rows('_about', 'option') ): the_row();
                    if( have_rows('connect_media') ):
                        echo 'Follow Us: ';
                        while( have_rows('connect_media') ): the_row();
                            $link = get_sub_field('link');
                            $platform = get_sub_field('platform');
                            $icon = '<a href="' . $link . '">' .
                                '<i class="' . $platform . '"></i>' .
                                '</a>';
                            echo $icon;
                        endwhile;
                    endif;
                endwhile;
            endif;

            // This is where you run the code and display the output
//            echo __( 'Hello, World!', 'connect_widget_domain' );
            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }
            else {
                $title = __( 'New title', 'connect_widget_domain' );
            }
            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <?php
        }

        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            return $instance;
        }

    } // close class

    // Register the widget
    register_widget( 'connect_widget' );

}
add_action( 'widgets_init', 'sbc_connect_widget' );