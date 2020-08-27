<?php
/**
 * The template for the individual blog posts
 */

get_header();

$id = get_the_ID();
$img = get_the_post_thumbnail($id, 'full', array( 'class' => 'feat-img' ));
$content = apply_filters('the_content', get_post_field('post_content', $id));

?>

    <!-- Child Header -->
    <?php child_page_header(null, ''); ?>

    <!-- Blog image and content -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col col-12 col-md-8">
                    <?php echo $img; ?>
                </div>
                <div class="col col-12 col-md-8">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </section>

<?php show_card_section(); ?>


<?php get_footer(); ?>