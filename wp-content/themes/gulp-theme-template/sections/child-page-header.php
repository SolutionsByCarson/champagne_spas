
<?php
/** CHILD-PAGE-HEADER.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: SBC child page header
// ----- Instructions: call "child_page_header()" to print the child page header
 **/

function child_page_header($page_title=null, $excerpt=null){
    if($page_title == null){
        $page_title = get_the_title();
    }
    if($excerpt == null){
        $excerpt = get_the_excerpt();
    }
    ?>
    <section class="child-header">
        <div class="container">
            <div class="row">
                <div class="col col-12">
                    <?php mj_wp_breadcrumb(); ?>
                    <h1 class="head child-head"><?php $page_title ?></h1>
                    <?php if($excerpt): ?>
                        <div class="child-desc-cont">
                            <p class="desc child-desc">
                                <?php echo $excerpt; ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>