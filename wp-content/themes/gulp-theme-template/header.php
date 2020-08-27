<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo the_title() . ' | ' . get_bloginfo('name'); ?></title>


    <?php wp_head() ;?>
    <?php if (get_field('header_code','option')){ the_field('header_code', 'option'); } ?>

</head>

<!-- START BODY -->
<body <?php body_class(); ?>>


<!--Add Customized Styles-->

<?php
if (get_field('body_code', 'option')) { the_field('footer_code', 'option'); }
if (get_field('font_embed_code', 'option')) { the_field('font_embed_code', 'option'); }
$primary = get_field('primary','option');
$secondary = get_field('secondary','option');
$tertiary = get_field('tertiary','option');
?>
<style>

.xl-primary { color: <?=$primary['xl']?>; }
.l-primary { color: <?=$primary['l']?>; }
.primary { color: <?=$primary['s']?>; }
.d-primary { color: <?=$primary['d']?>; }
.xd-primary { color: <?=$primary['xd']?>; }
.l-tertiary { color: <?=$tertiary['l']?>; }
.tertiary { color: <?=$tertiary['s']?>; }
.d-tertiary { color: <?=$tertiary['d']?>; }
.l-secondary { color: <?=$secondary['l']?>; }
.secondary { color: <?=$secondary['s']?>; }
.d-secondary { color: <?=$secondary['d']?>; }

.option-slides-outer .option-slides .option-slide .option-slide-body .option-slide-options .option-slide-option.checked label {
    color: <?=$primary['d']?>;
}

.bg-xl-primary {
background-color: <?=$primary['xl']?> !important; }

.bg-l-primary {
background-color: <?=$primary['l']?> !important; }

.bg-primary, a.feature-card.bg-primary:hover {
background-color: <?=$primary['s']?> !important; }
.bg-d-primary {
background-color:<?=$primary['d']?> !important; }

.bg-xd-primary {
background-color: <?=$primary['xd']?> !important; }

.bg-l-secondary {
background-color: <?=$secondary['l']?> !important; }

.bg-secondary {
background-color: <?=$secondary['s']?> !important; }

.bg-d-secondary {
background-color:<?=$secondary['d']?> !important; }

.bg-l-tertiary {
background-color: <?=$tertiary['l']?> !important; }

.bg-tertiary {
background-color: <?=$tertiary['s']?> !important; }

.bg-d-tertiary {
background-color:<?=$tertiary['d']?> !important; }

.btn-primary {
    color: #fff !important;
    border-color: <?=$primary['s']?> !important;
    background-color: <?=$primary['s']?> !important;}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active {
    color: #fff !important;
    border-color: <?=$primary['d']?> !important;
    background-color:  <?=$primary['d']?> !important;}
button.option-slide-header:hover,
button.option-slide-header:focus, button.option-slide-header:active,
.option-slides-outer .option-slides .option-slide.active .option-slide-header,
.option-slides-outer .option-slides .option-slide.current .option-slide-header{
    background: <?=$primary['d']?> !important;
    background-color:  <?=$primary['d']?> !important;
    outline: none !important;
}
.btn-outline-primary {
    color: <?=$primary['s']?> !important;
    border-color: <?=$primary['s']?> !important;}
.btn-outline-primary:hover, .btn-outline-primary:active, .btn-outline-primary:focus {
    color: #fff !important;
    background-color: <?=$primary['d']?> !important;
    border-color: <?=$primary['d']?> !important;}

.btn-secondary {
   color: #fff !important;
    border-color: <?=$secondary['s']?> !important;
   background-color: <?=$secondary['s']?> !important;}
.btn-secondary:hover, .btn-secondary:focus, .btn-secondary:active {
    color: #fff !important;
    border-color: <?=$secondary['d']?> !important;
    background-color:  <?=$secondary['d']?> !important;}
.btn-outline-secondary {
    color: <?=$secondary['s']?> !important;
    border-color: <?=$secondary['s']?> !important;}
.btn-outline-secondary:hover, .btn-outline-secondary:active, .btn-outline-secondary:focus {
    color: #fff !important;
    background-color: <?=$secondary['d']?> !important;
    border-color: <?=$secondary['d']?> !important;}


.btn-tertiary {
    color: #fff !important;
    border-color: <?=$tertiary['s']?> !important;
    background-color: <?=$tertiary['s']?> !important;}
.btn-tertiary:hover, .btn-tertiary:focus, .btn-tertiary:active {
    color: #fff !important;
    border-color: <?=$tertiary['d']?> !important;
    background-color:  <?=$tertiary['d']?> !important;}
.btn-outline-tertiary {
    color: <?=$tertiary['s']?> !important;
    border-color: <?=$tertiary['s']?> !important;}
.btn-outline-tertiary:hover, .btn-outline-tertiary:active, .btn-outline-tertiary:focus {
    color: #fff !important;
    background-color: <?=$tertiary['d']?> !important;
    border-color: <?=$tertiary['d']?> !important;}



#site_nav .nav-call-header {
    color: <?=$tertiary['s']?> !important;}
#site_nav .nav-call-header i {
    background: <?=$tertiary['s']?> !important;}
#site_nav .nav-call-header:hover {
    color: <?=$tertiary['d']?> !important; }
#site_nav .nav-call-header:hover i {
    background: <?=$tertiary['d']?> !important;}
#site_nav .navbar-collapse .nav-item.nav-cta > .nav-link {
    background: <?=$primary['s']?> !important; }
#site_nav .navbar-collapse .nav-item.nav-cta > .nav-link:hover {
    background: <?=$primary['d']?> !important; }
#site_nav .navbar-collapse:before {
    background: <?=$primary['d']?> !important;
    background-color: <?=$primary['d']?> !important;}

#site_nav .navbar-toggler {
    color: <?=$primary['s']?> !important;
}
#site_nav .navbar-toggler:hover, #site_nav .navbar-toggler:focus,
#site_nav.mobile-menu-open .navbar-toggler {
    background: <?=$primary['s']?> !important;
    background-color: <?=$primary['s']?> !important;
    color: white !important;
}
@media only screen and (max-width: 991.99px){
    #site_nav .navbar-collapse .navbar-nav .nav-item.nav-cta:not(.nav-call-mobile) > .nav-link {
        color: <?=$primary['s']?> !important;
        background: #ffffff !important;
    }
    #site_nav .navbar-collapse .navbar-nav .nav-item.nav-cta:not(.nav-call-mobile) > .nav-link:active,
    #site_nav .navbar-collapse .navbar-nav .nav-item.nav-cta:not(.nav-call-mobile) > .nav-link:focus,
    #site_nav .navbar-collapse .navbar-nav .nav-item.nav-cta:not(.nav-call-mobile) > .nav-link:hover {

    }
}
.section_brochure .divider {
    background: <?=$primary['l']?>
}
.section_features_b .feature-row .img-container:before,
.section_features_b .feature-row .img-container:after{
    background: <?=$primary['s']?>;
}
.section_features_b .feature-row.img-right .img-container:before,
.section_features_b .feature-row.img-right .img-container:after {
    background: <?=$secondary['s']?>;
}
.option-slides-outer .option-slide-tabs .option-slide-tab {
    background: <?=$primary['l']?>;
}
.option-slides-outer .option-slide-tabs .option-slide-tab.current, .option-slides-outer .option-slide-tabs .option-slide-tab:hover, .option-slides-outer .option-slide-tabs .option-slide-tab:focus,
.option-slides-outer .option-slide-tabs .option-slide-tab.current, .option-slides-outer .option-slide-tabs .option-slide-tab:hover, .option-slides-outer .option-slide-tabs .option-slide-tab:focus {
    background: <?=$primary['s']?>;
}
#site_nav .navbar-collapse .nav-item .nav-link:hover {
    color: <?=$primary['s']?>;
}
#site_nav .navbar-collapse .navbar-nav .nav-item.nav-cta > .nav-link:hover {
    color: white !important;
    background: <?=$tertiary['s']?> !important;
    border-color: <?=$tertiary['s']?> !important;
}
#site_nav .navbar-collapse .navbar-nav .nav-item:hover > .nav-link, #site_nav .navbar-collapse .navbar-nav .nav-item.active > .nav-link {
    color: white !important;
}
<?php $d = get_field('font_head','option'); ?>
h1, h2, h3, h4, h5, h6, .display-1, .display-2,
.h1, .h2, .h3, .h4, .h5, .h6 {
    <?php if ($d['font_family']): ?>font-family: <?=$d['font_family'];?>;<?php endif; ?>
    <?php if ($d['font_weight']): ?>font-weight: <?=$d['font_weight'];?>;<?php endif; ?>
    <?php if ($d['font_style']): ?>font-style: <?=$d['font_style'];?>;<?php endif; ?>
    <?php if ($d['line_height']): ?>line-height: <?=$d['line_height'];?>;<?php endif; ?>
    <?php if ($d['text_transform']): ?>text-transform: <?=$d['text_transform'];?>;<?php endif; ?>
}
<?php $d = get_field('font_body','option'); ?>
body, html {
    <?php if ($d['font_family']): ?>font-family: <?=$d['font_family'];?>;<?php endif; ?>
    <?php if ($d['font_weight']): ?>font-weight: <?=$d['font_weight'];?>;<?php endif; ?>
    <?php if ($d['font_style']): ?>font-style: <?=$d['font_style'];?>;<?php endif; ?>
    <?php if ($d['line_height']): ?>line-height: <?=$d['line_height'];?>;<?php endif; ?>
    <?php if ($d['text_transform']): ?>text-transform: <?=$d['text_transform'];?>;<?php endif; ?>
}
#site_nav .navbar-collapse .nav-item,
#site_nav .navbar-collapse .nav-item .nav-link {
    <?php if ($d['font_family']): ?>font-family: <?=$d['font_family'];?>;<?php endif; ?>
}
<?php $d = get_field('font_quote','option'); ?>
.quote {
    <?php if ($d['font_family']): ?>font-family: <?=$d['font_family'];?>;<?php endif; ?>
    <?php if ($d['font_weight']): ?>font-weight: <?=$d['font_weight'];?>;<?php endif; ?>
    <?php if ($d['font_style']): ?>font-style: <?=$d['font_style'];?>;<?php endif; ?>
    <?php if ($d['line_height']): ?>line-height: <?=$d['line_height'];?>;<?php endif; ?>
    <?php if ($d['text_transform']): ?>text-transform: <?=$d['text_transform'];?>;<?php endif; ?>
}
<?php $d = get_field('font_btn','option'); ?>
button, .btn, .btn-secondary, .btn-secondary, .btn-tertiary,
.btn-outline-primary, .btn-outline-secondary, .btn-outline-tertiary,
.btn-white, .btn-outline-white, .btn-black, .btn-outline-black, .txt-link {
    <?php if ($d['font_family']): ?>font-family: <?=$d['font_family'];?>;<?php endif; ?>
    <?php if ($d['font_weight']): ?>font-weight: <?=$d['font_weight'];?>;<?php endif; ?>
    <?php if ($d['font_style']): ?>font-style: <?=$d['font_style'];?>;<?php endif; ?>
    <?php if ($d['line_height']): ?>line-height: <?=$d['line_height'];?>;<?php endif; ?>
    <?php if ($d['text_transform']): ?>text-transform: <?=$d['text_transform'];?>;<?php endif; ?>
}
#site_nav .nav-call-header {
    <?php if ($d['font_family']): ?>font-family: <?=$d['font_family'];?>;<?php endif; ?>
    <?php if ($d['font_weight']): ?>font-weight: <?=$d['font_weight'];?>;<?php endif; ?>
    <?php if ($d['font_style']): ?>font-style: <?=$d['font_style'];?>;<?php endif; ?>
    <?php if ($d['line_height']): ?>line-height: <?=$d['line_height'];?>;<?php endif; ?>
    <?php if ($d['text_transform']): ?>text-transform: <?=$d['text_transform'];?>;<?php endif; ?>
}
<?=the_field('custom_css','option');?>
</style>
<?php

$logo_bg = get_field('logo_bg');
$logo_link = get_field('logo_link');
$logo_size = 'size-' . get_field('logo_size');

if (get_field('logo_size') == 'larger'){
    $logo = wp_get_attachment_image(get_field('site_logo'),'larger-site-logo',array('class','logo'));
} else {
    $logo = wp_get_attachment_image(get_field('site_logo'),'site-logo',array('class','logo'));
}

if ($logo_bg == 'no' || $logo_bg = 'white'){
    $logo_bg = 'bg-' . $logo_bg;
} else {
    $logo_bg = 'md-bg-' . $logo_bg;
}
?>
<nav class="navbar navbar-expand-lg" id="site_nav">

    <div class="container-fluid">
        <a class="navbar-brand <?=$logo_bg?> <?=$logo_size?>" href="<?=$logo_link?>">
            <?=$logo?>
        </a>
        <?php if (get_field('show_phone')): ?>
        <a href="tel:<?=get_field('phone')?>" class="nav-call-header">
            <i class="fas fa-mobile-alt"></i>
            Call <?=get_field('phone')?>
        </a>
        <?php endif; ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#top_nav" aria-controls="top_nav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="top_nav">
            <ul class="navbar-nav ml-auto">
                <?php $menu = get_field('top_menu'); ?>
                <?php if ($menu): ?>
                <?php foreach ($menu as $d): ?>
                <?php if ($d['cta']){ $class = 'nav-cta'; } else { $class = ''; } ?>
                 <?php if ($d['open_modal']): ?>
                    <li class="nav-item <?=$class?>">
                        <a class="nav-link" href="<?=$d['link']?>" data-toggle="modal" data-target="<?=$d['link']?>"><?=$d['txt']?></a>
                    </li>
                 <?php else: ?>
                    <li class="nav-item <?=$class?>">
                        <a class="nav-link" href="<?=$d['link']?>" target="<?=$d['target']?>"><?=$d['txt']?></a>
                    </li>
                 <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php if (get_field('show_phone')): ?>
                <li class="nav-item nav-cta nav-call-mobile">
                    <a class="nav-link" href="tel:<?=get_field('phone')?>"><i class="fas fa-mobile-alt"></i> Call <?=get_field('phone')?></a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<!-- START CONTENT -->
<div id="content" >