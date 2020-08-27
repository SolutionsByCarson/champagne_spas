<?php
/**
 * The front page: this page will automatically be used
 * for the front page declared in wp settings > reading
 */

get_header();
$show_section = get_field('show_sections');
?>

<!-- TOP HERO -->
<?php
$d = get_field('top_hero');
$banner_position = $d['banner_position'];

?>
<?php if ($show_section['top_hero']): ?>
<section class="section_hero hero large <?=$banner_position?>" id="top_hero">

        <?php
        if ($banner_position != 'banner-top'):

            if ($d['img']['img_sizing'] == 'multi'):
                _bg_img($d['img']['xxl'],'full','xxl-bg');
                _bg_img($d['img']['xl'],'full','xl-bg');
                _bg_img($d['img']['l'],'full','l-bg');
                _bg_img($d['img']['m'],'full','m-bg');
                _bg_img($d['img']['s'],'full','s-bg');
                _bg_img($d['img']['xs'],'full','xs-bg');
            else:
                _bg_img($d['img']['single'],'full','full-bg');
            endif;

        endif; ?>
    <div class="hero_overlay <?=$d['overlay_color']?>" id="hero_overlay_1"></div>
    <div class="hero_overlay <?=$d['overlay_color']?>" id="hero_overlay_2"></div>
        <div class="container">
            <div class="row">
                <div class="col hero-col">
                    <div class="hero-inner <?=$d['banner_bg']?> <?=$d['banner_border']?>">
                        <?php if ($d['head']): ?><h1 class="head display-1 mb-2"><?=$d['head'];?></h1><?php endif; ?>
                        <?php if ($d['sub']): ?><p class="sub quote"><?=$d['sub'];?></p><?php endif; ?>
                        <div class="btn-group">
                            <?php _btn($d['a_btn']); ?>
                            <?php if( $d['show_btn_2']){ _btn($d['b_btn']); } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($banner_position == 'banner-top'):
            if ($d['img']['img_sizing'] == 'multi'):
                _bg_img($d['img']['xxl'],'full','xxl-bg');
                _bg_img($d['img']['xl'],'full','xl-bg');
                _bg_img($d['img']['l'],'full','l-bg');
                _bg_img($d['img']['m'],'full','m-bg');
                _bg_img($d['img']['s'],'full','s-bg');
                _bg_img($d['img']['xs'],'full','xs-bg');
            else:
                _bg_img($d['img']['single'],'full','full-bg');
            endif;
        endif; ?>
</section>
<?php endif; ?>

<!-- MEDIA SECTION -->
<?php $d = get_field('section_media'); ?>
<?php if ($show_section['media']): ?>
<section class="section_media" id="media">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 mb-5 mb-lg-0">
                <?php if ($d['media_type'] == 'video'): ?>
                    <div class="video-wrap">
                        <?=$d['video']?>
                    </div>
                <?php else: ?>
                    <?php echo wp_get_attachment_image($d['img'],'card-img',false); ?>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-6 media-col">
                <?php if ($d['head']): ?><h2 class="primary"><?=$d['head'];?></h2><?php endif; ?>
                <?php if ($d['sub']): ?><p class="quote"><?=$d['sub'];?></p><?php endif; ?>
                <?php if ($d['desc']): ?><?=$d['desc'];?><?php endif; ?>
                <?php if ($d['show_txt_link']){ _txt_link($d['txt_link'], ['class'=>'primary mt-3']); } ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>



<!-- TOP FEATURES SECTION -->
<?php $d = get_field('section_features_a'); ?>
<?php if ($show_section['features_a']): ?>
<section class="section_features_a" id="offers">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <?php if ($d['head']): ?><h2 class="text-center mb-3 primary"><?=$d['head'];?></h2><?php endif; ?>
                <?php if ($d['sub']): ?><p class="quote text-center mb-3"><?=$d['sub'];?></p><?php endif; ?>
                <?php if ($d['desc']): ?><div class="text-center mb-3"><?=$d['desc'];?></div><?php endif; ?>
            </div>
            <?php $rows = $d['features']; ?>
            <?php $col_class=col_check(count($rows)); ?>
            <?php $c = 1; ?>
            <?php foreach ($rows as $row): ?>
            <div class="<?=$col_class?>">
                <a class="feature-card <?='bg-'.check($c);?>" href="<?=$row['link']?>">
                    <div class="head <?='bg-'.check($c++);?>">
                        <h3 class="white"><?=$row['head']?></h3>
                    </div>
                    <?=wp_get_attachment_image($row['img'],'card-img',false);?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="bg-xl-primary" id="top_feature_bg"></div>
</section>
<?php endif; ?>

    <!-- BROCHURE SECTION -->
<?php $d = get_field('section_brochure'); ?>
<?php if ($show_section['brochure']): ?>
    <section class="section_brochure <?=$d['bg_color']?> <?=$d['pad']=='default'?null:$d['pad'];?>" id="top_brochure">
        <?php if($d['overlay_bg']){ echo '<div class="overlay ' . $d['bg_color'] . '" style="opacity: ' . $d['overlay_opacity'] . ';"></div>'; } ?>
        <?php if($d['bg_img']){ _bg_img($d['bg_img'],'full','full-bg ' . $d['bg_img_position']); } ?>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 mb-5 mb-lg-0 vertical-center">
                    <?php echo wp_get_attachment_image($d['header_img'],'full',false, ['class'=>'head-img']); ?>
                    <?php if ($d['head']): ?><h2 class="d-gray"><?=$d['head'];?></h2><?php endif; ?>
                    <?php if ($d['sub']): ?><p class="quote"><?=$d['sub'];?></p><?php endif; ?>
                    <?php if ($d['desc']): ?><?=$d['desc'];?><?php endif; ?>
                    <?php if ($d['show_divider']):?><div class="divider <?=$d['divider_color']?>"></div><?php endif; ?>
                    <div class="btn-group mt-3">
                        <?php if( $d['show_btn']){ _btn($d['btn']); } ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <?php echo wp_get_attachment_image($d['img'],'full',false, ['class'=>'media-img']); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- TOP CTA -->
<?php
    $d = get_field('section_top_cta');
    $bg_style = $d['bg_style'];
?>
<?php if ($show_section['top_cta']): ?>
<section class="section_top_cta hero <?=$bg_style?>" id="top_cta">
    <?php _bg_img($d['img']); ?>
    <div class="top_cta_overlay <?=$d['overlay_color']?>" id="top_cta_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col hero-col">
                <div class="hero-inner white">
                    <?php if ($d['head']): ?><h2 class="mb-4"><?=$d['head'];?></h2><?php endif; ?>
                    <?php if ($d['desc']): ?><?=$d['desc'];?><?php endif; ?>
                    <div class="btn-group">
                        <?php if( $d['show_btn']){ _btn($d['btn']); } ?>
                    </div>
                </div>
            </div>
<!-- BUILD & PRICE OPTIONS - ENTER BELOW -->
        </div>
    </div>
</section>
<?php endif; ?>


<!-- FEATURES REPEATER SECTION -->
<?php $d = get_field('section_features_b'); ?>
<?php if ($show_section['features_b']): ?>
    <section class="section_features_b" id="features_repeater">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <?php if ($d['head']): ?><h2 class="text-center mb-3 primary"><?=$d['head'];?></h2><?php endif; ?>
                    <?php if ($d['sub']): ?><p class="quote text-center mb-3"><?=$d['sub'];?></p><?php endif; ?>
                    <?php if ($d['desc']): ?><div class="text-center mb-3"><?=$d['desc'];?></div><?php endif; ?>
                </div>
            </div>
                <?php $rows = $d['features']; ?>
                <?php $c = 1; ?>
                <?php foreach ($rows as $row): ?>
                <?php $color = check($c); $bg = 'bg-'.check($c++); ?>

                    <?php if ($color == 'primary'): ?>
                    <div class="row feature-row mb-5 img-left">
                        <div class="col-12 col-md-4 img-col mb-5 mb-lg-0">
                            <div class="img-container">
                            <?php echo wp_get_attachment_image($row['img'],'feature-repeater-img',false); ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 copy-col text-center-mobile">
                            <?php if ($row['head']): ?><h3 class="<?=$color;?>"><?=$row['head'];?></h3><?php endif; ?>
                            <?php if ($row['sub']): ?><p class="quote <?=$color;?>"><?=$row['sub'];?></p><?php endif; ?>
                            <?php if ($row['desc']): ?><?=$row['desc'];?><?php endif; ?>
                            <?php if ($row['show_txt_link']){ _txt_link($row['txt_link'], ['class'=> $color . ' mt-3']); } ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row feature-row mb-5 img-right">
                        <div class="col-12 col-md-4 img-col d-block d-md-none mb-5 mb-lg-0">
                            <div class="img-container mobile-only">
                                <?php echo wp_get_attachment_image($row['img'],'feature-repeater-img',false); ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 copy-col text-center-mobile">
                            <?php if ($row['head']): ?><h3 class="<?=$color;?>"><?=$row['head'];?></h3><?php endif; ?>
                            <?php if ($row['sub']): ?><p class="quote <?=$color;?>"><?=$row['sub'];?></p><?php endif; ?>
                            <?php if ($row['desc']): ?><?=$row['desc'];?><?php endif; ?>
                            <?php if ($row['show_txt_link']){ _txt_link($row['txt_link'], ['class'=> $color . ' mt-3']); } ?>
                        </div>
                        <div class="col-12 col-md-4 img-col d-none d-md-block">
                            <div class="img-container">
                            <?php echo wp_get_attachment_image($row['img'],'feature-repeater-img',false); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <div class="bg-primary" id="top_feature_bg"></div>
    </section>
<?php endif; ?>

<!-- BOTTOM BROCHURE SECTION -->
<?php $d = get_field('section_bottom_brochure'); ?>
<?php if ($show_section['bottom_brochure']): ?>
    <section class="section_bottom_brochure bg-primary" id="bottom_brochure">
        <div class="container">
            <div class="row">
                <div class="d-none d-md-block col-md-6" style="z-index: 1;">
                    <?php echo wp_get_attachment_image($d['img'],'full',false, ['class'=>'media-img']); ?>
                </div>
                <div class="col-12 col-md-6 mb-5 mb-lg-0 white vertical-center">
                    <?php echo wp_get_attachment_image($d['header_img'],'full',false, ['class'=>'head-img']); ?>
                    <?php if ($d['head']): ?><h2 class="white"><?=$d['head'];?></h2><?php endif; ?>
                    <?php if ($d['sub']): ?><p class="quote white"><?=$d['sub'];?></p><?php endif; ?>
                    <?php if ($d['desc']): ?><?=$d['desc'];?><?php endif; ?>
                    <?php if ($d['show_divider']):?><div class="divider <?=$d['divider_color']?>"></div><?php endif; ?>
                    <div class="btn-group mt-3">
                        <?php if( $d['show_btn']){ _btn($d['btn']); } ?>
                    </div>
                </div>
                <div class="d-block d-md-none">
                    <?php echo wp_get_attachment_image($d['img'],'full',false, ['class'=>'media-img']); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- FEATURES SECTION C -->
<?php $d = get_field('section_features_c'); ?>
<?php if ($show_section['features_c']): ?>
    <section class="section_features_c bg-xl-primary" id="features_grid">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <?php if ($d['head']): ?><h2 class="text-center mb-3 primary"><?=$d['head'];?></h2><?php endif; ?>
                    <?php if ($d['sub']): ?><p class="quote text-center mb-3"><?=$d['sub'];?></p><?php endif; ?>
                    <?php if ($d['desc']): ?><div class="text-center mb-3"><?=$d['desc'];?></div><?php endif; ?>
                </div>
                <?php $rows = $d['features']; ?>
                <?php $col_class=col_check(count($rows)); ?>
                <?php foreach ($rows as $row): ?>
                    <div class="<?=$col_class?>">
                        <a class="feature-card mb-5 mb-md-0 bg-primary" href="<?=$row['link']?>">
                            <div class="head">
                                <h3 class="bg-primary white"><?=$row['head']?></h3>
                            </div>
                            <?=wp_get_attachment_image($row['img'],'card-img',false);?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- BOTTOM CTA -->
<?php
    $d = get_field('section_bottom_cta');
    $bg_style = $d['bg_style'];
?>
<?php if ($show_section['bottom_cta']): ?>
    <section class="section_bottom_cta hero <?=$bg_style?>" id="bottom_cta">
        <?php _bg_img($d['img']); ?>
        <div class="bottom_cta_overlay <?=$d['overlay_color']?>" id="bottom_cta_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col hero-col">
                    <div class="hero-inner white">
                        <?php if ($d['head']): ?><h2 class="mb-4"><?=$d['head'];?></h2><?php endif; ?>
                        <?php if ($d['desc']): ?><?=$d['desc'];?><?php endif; ?>
                        <div class="btn-group">
                            <?php if( $d['show_btn']){ _btn($d['btn']); } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<!--DESIGN BUILD SECTION-->
<?php
$d = get_field('section_design_build');
if($show_section['design_build']):

    // get options vars
    $options = $d['options'];
    $o_count = count($options) + 1;

    // only print section if there are options
    if($options):
?>
<section class="section_design_build" id="design_build">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <?php if ($d['head']): ?><h2 class="text-center mb-3 primary"><?=$d['head'];?></h2><?php endif; ?>
                <?php if ($d['sub']): ?><p class="quote text-center mb-3 secondary"><?=$d['sub'];?></p><?php endif; ?>
                <?php if ($d['desc']): ?><div class="text-center mb-3"><?=$d['desc'];?></div><?php endif; ?>
            </div>
            <div class="col-12">
                <div class="option-slides-outer">

                <?php
                    // build vars
                    $tabs = "";
                    $slides = "";
                    $c = 1;

                    // loop through options
                    foreach($options as $option):

                        // mark the first option as "current"
                        if ($c == 1){
                            $current = "current";
                        } else {
                            $current = null;
                        }

                        // radio or checkbox
                        if ($option['select_multiple']){
                            $input_class = 'checkbox';
                            $input_prompt = '<p class="mt-2 mb-0 white small">*Select All That Apply</p>';
                        } else {
                            $input_class = 'radio';
                            $input_prompt = '';
                        }

                        // filter by
                        if ($option['filter_by']){
                            $filter_by = 'filter-by-' . $option['filter_by'];
                        } else {
                            $filter_by = '';
                        }

                        // get option vars
                        $variants = $option['variants'];
                        $v_count = count($variants);
                        $o_id = 'option_' . $option['id'];
                        $o_class = 'option-' . $option['id'];

                        // only print options if variants are included
                        if ($variants):

                        // build tab
                        $tabs .= '<button class="option-slide-tab ' . $current . '" " data-order="' . $c . '">' . $option['head'] . '</button>';

                        // build slide
                        $slides .= '<div class="option-slide ' . $current . '"  data-filter="' . $filter_by . '" data-order="' . $c . '" id="' . $o_id . '" data-title="' . $option['head'] . '">';
                            $slides .= '<button type="button" class="option-slide-header bg-primary">';
                                $slides .= '<h4>' . $option['head'] . '</h4>';
                                $slides .= '<i class="fas fa-chevron-down"></i>';
                            $slides .= '</button>';
                        $slides .= '<div class="option-slide-body">';
                        $slides .= '<div class="option-slide-label text-center d-none d-md-block bg-primary"><h4 class="white mb-0">' . $option['head'] . '</h4>' . $input_prompt . '</div>';
                        $slides .= '<div class="option-slide-body-inner">';
                        $slides .= '<div class="option-slide-options ' . $option['grid_style'] . '">';

                            foreach ($variants as $v):

                                // variant ID
                                $v_id = $o_id . '_' . $v['id'];
                                $v_filter_by = $v['show_value'];

                                if( $option['show_label'] ){
                                    $img_class = 'design-build-img';
                                } else {
                                    $img_class = 'design-build-img mb-0';
                                }

                                $slides .= '<div class="option-slide-option ' . $o_class . '" data-filter="' . $v_filter_by . '">';
                                $slides .= wp_get_attachment_image($v['img'], 'builder-img', false, array('class'=>$img_class));
                                if ($option['show_label']):
                                    $slides .= '<label class="primary h5" for="' . $v_id . '"><i class="far fa-square"></i>' . $v['head'] . '</label>';
                                endif;
                                $slides .= '<input type="checkbox" class="design-option-input ' . $input_class . '" data-id="' . $v['id'] . '" name="' . $option['id'] . '" value="' . $v['head'] . '" id="' . $v_id . '" aria-label="' . $v['head'] . '">';
                                $slides .= '</div>';
                            endforeach;
                        
                        $slides .= '</div>';
                        $slides .= '<div class="option-slide-btns">';
                        $slides .= '<div class="btn-outer"><button type="button" class="option-slide-prev btn btn-outline-primary">Previous</button></div>';
                        $slides .= '<div class="btn-outer"><button type="button" class="option-slide-next btn btn-primary">Next</button></div>';
                        $slides .= '</div>';
                        $slides .= '</div>';
                        $slides .= '</div>';
                        $slides .= '</div>';
                        $c++;

                        endif;

                    endforeach;
                ?>

                <?php if ($tabs): ?>
                <div class="option-slide-tabs d-none d-md-flex">
                    <?=$tabs?>
                    <button class="option-slide-tab" data-order="<?=$c?>"> <?=$d['form']['head']?></button>
                </div>
                <?php endif; ?>

                <!-- Design Slide Container -->
                <?php if ($slides): ?>
                <div class="option-slides" data-current="1" data-max="<?=$o_count?>">
                    <?=$slides?>
                    <div class="option-slide" data-order="<?=$c?>" id="<?=$d['form']['id']?>" data-title="<?=$d['form']['head']?>">
                        <button type="button" class="option-slide-header bg-primary">
                            <h4><?=$d['form']['head']?></h4>
                            <i class="fas fa-chevron-down" aria-hidden="true"></i>
                        </button>
                        <div class="option-slide-body">
                            <div class="option-slide-body-inner">
                                <div class="option-slide-options one-col">
                                    <div class="option-form-container">
                                        <?=$d['form']['content']?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php endif; ?>

<!--LOCATIONS SECTION-->
<?php $d = get_field('section_locations'); ?>
<?php if ($show_section['locations']): ?>
    <section class="section_locations bg-xl-primary" id="locations">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if ($d['head']): ?><h2 class="text-center mb-3 primary"><?=$d['head'];?></h2><?php endif; ?>
                    <?php if ($d['sub']): ?><p class="text-center mb-5 quote"><?=$d['sub'];?></p><?php endif; ?>
                </div>
                <?php $rows = $d['locations']; ?>
                <?php $col_class=col_check(count($rows)); ?>
                <?php foreach ($rows as $row):
                    $address = _address($row['address']);
                    if ($row['link']){
                        $link = $row['link'];
                        if ($row['link_txt']){
                            $link_txt = $row['link_txt'];
                        } else {
                            $link_txt = 'Learn More';
                        }
                    } elseif ( $row['address']['address_line_1'] ){
                        $link = $address['link'];
                        $link_txt = 'Get Directions';
                    }
                ?>
                <div class="<?=$col_class?>">
                    <div class="card mb-5 mb-lg-0">
                        <?=wp_get_attachment_image($row['img'],'card-img',false, array('class'=>'card-img-top'));?>
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?=$row['head']?></h5>
                            <span class="card-meta-group l-primary">
                            <?php if( $row['address']['address_line_1'] ): ?>
                                <span class="card-meta">
                                    <a href="<?=$address['link']?>" class="l-primary" target="_blank">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span class="meta-value">
                                        <?=$address['string']?>
                                    </span>
                                    </a>
                                </span>
                            <?php endif; ?>
                            <?php if( $row['hours'] ): ?>
                                <span class="card-meta">
                                    <i class="fas fa-clock"></i>
                                    <span class="meta-value">
                                        <?=$row['hours']?>
                                    </span>
                                </span>
                            <?php endif; ?>
                            <?php if( $row['phone'] ): ?>
                                <span class="card-meta">
                                    <a href="tel:<?=$row['phone']?>" class="l-primary" target="_blank">
                                    <i class="fas fa-mobile-alt"></i>
                                    <span class="meta-value">
                                        <?=$row['phone']?>
                                    </span>
                                    </a>
                                </span>
                            <?php endif; ?>
                            </span>
                            <?php if ($link): ?>
                                <a href="<?=$link;?>" class="btn btn-primary"><?=$link_txt;?><i class="fas fa-arrow-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!--LOCATIONS SECTION-->
<?php $d = get_field('section_single_location'); ?>
<?php if ($show_section['single_location']): ?>
    <section class="section_single_location bg-xl-primary" id="location">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 col-md-6 mb-md-0">
                    <?php if ($d['head']): ?><h2 class="mb-3 primary"><?=$d['head'];?></h2><?php endif; ?>
                    <?php if ($d['sub']): ?><p class="quote mb-3 secondary"><?=$d['sub'];?></p><?php endif; ?>
                    <?php if ($d['cont']): ?><div class="mb-3"><?=$d['cont'];?></div><?php endif; ?>
                    <div class="btn-group">
                        <?php if( $d['show_btn']){ _btn($d['btn']); } ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <?php if ($d['map_embed']): ?><div class="map-embed"><?=$d['map_embed'];?></div><?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>