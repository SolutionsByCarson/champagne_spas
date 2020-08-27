<?php
/** PARENT_PAGE_HEADER.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: SBC parent page header
// ----- Instructions: call "parent_page_header()" to print the parent page header
 **/
function parent_page_header($page_title=null, $desc=null, $bg_img=null, $bg_color=null){
    if($page_title == null){
        $page_title = get_the_title();
    }
    if($desc == null){
        $desc = get_the_excerpt();
    }
    ?>
    <section class="parent-header">
        <!-- full width background - defaults to bg-primary class -->
        <div class="container-fluid <?php echo $bg_color; ?>">
            <!-- content width container -->
            <div class="container">
                <div class="row">
                    <div class="col col-12">
                        <?php mj_wp_breadcrumb(); ?>
                        <h1 class="head parent-head"><?php $page_title ?></h1>
                        <?php if($desc): ?>
                            <div class="parent-desc-cont">
                                <p class="desc parent-desc">
                                    <?php echo $desc; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!--
                -- full width background image if a background image is used
                -- styles are applied to the container
                -- overlay is applied to the container
            -->
            <div class="header-bg-img-cont">
                <?php if($bg_img != null): echo $bg_img; endif; ?>
            </div>
        </div>
    </section>
<?php } ?>