<?php
/** ELEMENTS.PHP
// ----- Version: 1.0
// ----- Released: 5.5.2020
// ----- Description: Declare build functions for all ACF elements
// ----- ***ALL FUNCTIONS START WITH "b_"
 * **/

// --------------------------------------------------------
// ---------------- OVERRIDES FUNCTION
// --------------------------------------------------------

function _set_overrides ( $d=null, $ov=null )
{
    if ($ov){
        foreach ($ov as $label => $value){
            $d[$label] = $value;
        }
    }
    return $d;
}


// --------------------------------------------------------
// ---------------- BUTTONS
// --------------------------------------------------------


function _btn($d=null, $ov=null) {

        // Set value defaults
        if ( !$d['class'] ){ $d['class'] = _default('color'); }
        if ( !$d['txt'] ){ $d['txt'] = get_the_title(); }
        if ( !$d['link'] ){ $d['link'] = get_the_permalink(); }
        if ( !$d['icon'] ){ $d['icon'] = _default('icon'); }
        if ( !$d['target'] ){ $d['target'] = '_self'; }

    // SET OVERRIDES
    $d = _set_overrides($d, $ov);

    //  Print btn
    if ($d['open_modal']): ?>
    <a href="<?=$d['link']?>" class="btn <?=$d['class']?>" data-toggle="modal" data-target="<?=$d['link']?>">
        <?=$d['txt'] . ' ' . $d['icon']?>
    </a>
    <?php else: ?>
    <a href="<?=$d['link']?>" class="btn <?=$d['class']?>" target="<?=$d['target']?>">
        <?=$d['txt'] . ' ' . $d['icon']?>
    </a>
    <?php endif;
}



function _btn_group($d, $class=null)
{
    if ($d):
        ?>
        <div class="btn-group <?=$class?>" role="group">
            <?php foreach ($d as $row): ?>
                <?php _btn($row['btn'], $class); ?>
            <?php endforeach; ?>
        </div>
    <?php
    endif;
}

// --------------------------------------------------------
// ---------------- TEXT LINK
// --------------------------------------------------------

function _txt_link( $d=null, $ov=null ){

    // Set value defaults
    if ( !$d['class'] ){ $d['class'] = _default('color'); }
    if ( !$d['txt'] ){ $d['txt'] = get_the_title(); }
    if ( !$d['link'] ){ $d['link'] = get_the_permalink(); }
    if ( !$d['icon'] ){ $d['icon'] = _default('icon'); }
    if ( !$d['target'] ){ $d['target'] = '_self'; }

    // SET OVERRIDES
    $d = _set_overrides($d, $ov);

    //print btn
    if ($d['open_modal']): ?>
        <a href="<?=$d['link']?>" class="txt-link <?=$d['class']?>" data-toggle="modal" data-target="<?=$d['link']?>">
            <?=$d['txt'] . ' ' . $d['icon']?>
        </a>
    <?php else: ?>
    <a href="<?=$d['link']?>" class="txt-link <?=$d['class']?>" target="<?=$d['target']?>">
        <?=$d['txt'] . ' ' . $d['icon']?>
    </a>
    <?php endif;
}

// --------------------------------------------------------
// ---------------- TEXT GROUPS
// --------------------------------------------------------

function _txt_group($d=null, $head_element='h2', $head_class=null, $sub_class=null, $desc_class=null){

    // Set value defaults
    if ( !$d['head'] ){ $d['head'] = get_the_title(); }
    if ( !$d['sub'] ){ $d['sub'] = _default('sub'); }
    if ( !$d['desc'] ){ $d['desc'] = _default('desc'); }
    ?>

    <div class="txt-group">
        <?php if( $d['head'] ){ echo '<' . $head_element . ' class="head ' . $head_class . '">' . $d['head'] . '</' . $head_element . '>'; } ?>
        <?php if( $d['sub'] ){ echo '<p class="quote ' . $sub_class . '">' . $d['head'] . '</p>'; } ?>
        <?php if( $d['desc'] ){ echo '<p class="desc ' . $desc_class . '">' . $d['quote'] . '</p>'; } ?>
    </div>

    <?php
}

// --------------------------------------------------------
// ---------------- BACKGROUND ELEMENTS
// --------------------------------------------------------


function _overlay($class=null){

    // handle defaults
    if ( !$class ){ $class = _default('overlay'); }
    elseif ( !endsWith($class,'-bg') ){ $class=$class.'-bg'; };

    ?>
    <div class="overlay <?=$class?>"></div>
    <?php
}


function _bg_img( $img=null, $size='full', $class=null){

    // handle defaults
    if ( !$img ){ get_post_thumbnail_id(); }
    if ( !$img ){ _default('bg_img'); }

    // get img url
    $img_url = wp_get_attachment_image_src($img, $size)[0];
    ?>
        <div class="img-bg contained <?=$class?>" style="background-image:url('<?=$img_url?>');"></div>
    <?php
}

function _address($d){

    // build string address
    $string = '';
    $string .= $d['address_line_1'] . '<br>';
    if ($d['address_line_2']){ $string .= $d['address_line_2'] . '<br>'; }
    $string .= $d['city'] . ', ' . $d['state'] . ' ' . $d['zip'];

    // build google maps link
    $link = '';
    $link .= "https://www.google.com/maps/place/";
    $link .= $d['address_line_1'];
    if ($d['address_line_2']){ $link .= ', ' . $d['address_line_2']; }
    $link .= $d['city'] . ', ' . $d['state'] . ' ' . $d['zip'];

    // replace spaces with +
    $link = str_replace(' ','+',$link);

    // return array
    return array(
            'string' => $string,
            'link' => $link,
    );
}

// --------------------------------------------------------
// ---------------- HERO
// --------------------------------------------------------


function _hero($d, $class=null, $id=null, $head_element='h2', $head_class=null, $sub_class=null, $desc_class=null){

?>
<div class="hero <?=$class;?>" <?=$id?'id="'.$id.'"':null;?>>
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <div class="hero-inner">
                    <?php _txt_group($d['txt_group'], $head_element, $head_class, $sub_class, $desc_class); ?>
                    <?php _btn_group($d['btn_group']); ?>
                </div>
            </div>
        </div>
    </div>
    <?php _bg_img($d['img']); ?>
    <?php _overlay(); ?>
</div>

<?php
}

// --------------------------------------------------------
// ---------------- HERO SLIDER
// --------------------------------------------------------

function _hero_slider($d, $class=null, $id=null, $head_element='h2', $head_class=null, $sub_class=null, $desc_class=null){

    $indicators = '';

    // create counter
    $c = 0;

    if ($d['hero_slides']): ?>
        <div class="carousel slide hero-slider <?=$class;?>" <?=$id?'id="'.$id.'"':null;?> >
            <div class="carousel-inner">
                <?php foreach ($d['hero_slides'] as $row): ?>
                    <?php $c++==0?$active = "active":$active=null; ?>
                    <div class="carousel-item <?=$active; ?>" style="position: relative;">
                        <?php $indicators .= '<li data-target="#' . $id . '" data-slide-to="' . $c . '" class="' . $active . '"></li>'; ?>
                        <?php _hero($row['hero'], $class, $id . '_' . $c, $head_element, $head_class, $sub_class, $desc_class); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <ol class="carousel-indicators">
                <?php echo $indicators; ?>
            </ol>
            <a class="carousel-control-prev" href="#<?=$id?>" role="button" data-slide="prev">
                <i class="fas fa-chevron-circle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#<?=$id?>" role="button" data-slide="next">
                <i class="fas fa-chevron-circle-right"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>

    <?php endif;
}


// --------------------------------------------------------
// ---------------- MODAL BUILDER
// --------------------------------------------------------



// --------------------------------------------------------
// ---------------- SLIDER
// --------------------------------------------------------


function comp_slider($d){

    // get attribute vals
    $atts = b_atts($d['atts']);

    // build class attribute
    $class = 'class="' . concat(array(
            'carousel slide slider',
            $atts['class'],
        )) . '"';

    // build id attribute
    $id = $atts['id']?'id="' . $atts['id'] . '"':'slider';

    // combine all attributes
    $all_atts = concat(array(
        $id,
        $class,
        $atts['other_atts'],
        'data-ride="carousel"',
    ));

    // create counter
    $c = 0;

    // create carousel indicator var
    $indicators = "";

if ($d['slides']): ?>
    <div <?=$all_atts?>>
        <div class="carousel-inner">
            <?php foreach($d['slides'] as $row): ?>
            <?php $c++==0?$active = " active":$active=null; ?>
                <div class="carousel-item<?php echo $active; ?>">
                    <?php $indicators .= '<li data-target="#' . $atts['id'] . '" data-slide-to="' . $c . '" class="' . $active . '"></li>'; ?>
                    <?php echo '<div class="img-bg contained" style="background-image:url(' . wp_get_attachment_image_src($row['img'], 'slider-img')[0] . ');"></div>'; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <ol class="carousel-indicators">
            <?php echo $indicators; ?>
        </ol>
        <a class="carousel-control-prev" href="#<?php echo $atts['id']; ?>" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#<?php echo $atts['id']; ?>" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php endif;
}


// --------------------------------------------------------
// ---------------- ACCORDION
// --------------------------------------------------------

function b_accordion($d, $head_elem='p', $head_class='h3', $parent, $c)
{

    // get vars
    $hid = $parent . "_heading_" . $c;
    $cid = $parent . "_collapse_" . $c;

    // expand/show first
    $c==0?$expand='true':$expand='false';
    $c==0?$show=' show':$show='';

?>
    <div class="card accordion-card">
        <div class="card-header" id="<?=$hid?>">
            <<?=$head_elem?> class="<?=$head_class?> btn btn-link" type="button" data-toggle="collapse" data-target="<?='#'.$cid?>" aria-expanded="<?=$expand?>" aria-controls="<?=$cid?>>">
                    <?=$d['head']?>
            </<?=$head_elem?>>
        </div>
        <div id="<?=$cid?>" class="collapse<?=$show?>" aria-labelledby="<?=$hid?>" data-parent="<?='#'.$parent?>">
            <div class="card-body">
                <?=$d['cont']?>
            </div>
        </div>
    </div>
<?php
}



function comp_accordions($d)
{

    // get attribute vals
    $atts = b_atts($d['atts']);

    // build class attribute
    $class = 'class="' . concat(array(
            'accordion',
            $atts['class'],
        )) . '"';

    // build id attribute
    $id = $atts['id']?'id="' . $atts['id'] . '"':'accordions';

    // combine all attributes
    $all_atts = concat(array(
        $id,
        $class,
        $atts['other_atts']
    ));

    // create counter
    $c = 0;

    // if repeater has rows
    if ($d['accordion']):
?>

<div <?=$all_atts?>>
    <?php foreach($d['accordion'] as $row):
        b_accordion($row, $head_elem='p', $head_class='h3', $atts['id'], $c++);
    endforeach; ?>
</div>

    <?php endif;
}


// --------------------------------------------------------
// ---------------- TABS
// --------------------------------------------------------

function b_tab($d, $head_elem='p', $head_class='h3', $parent, $c)
{

    // get vars
    $cid = $parent . "_tab_" . $c;
    $hid = $cid . "_tab";

    // show/active first
    $c==0?$show=' show active':$show='';
    $c==0?$active=' active':$active='';
    $c==0?$selected='true':$selected='false';

    // build tab content
    $content =
        '<div class="tab-pane fade' . $show . '" id="' . $cid . '" role="tabpanel" arialabelledby="' . $hid . '">' .
            $d['cont'] .
        '</div>';

    // build tab nav
    $tab =
        '<li class="nav-item">' .
            '<a class="nav-link' . $active . '" id="' . $hid . '" data-toggle="tab" href="#' . $cid . '" role="tab" aria-controls="' . $cid . '" aria-selected="' . $selected . '">' .
                $d['head'] .
            '</a>' .
        '</li>';

    return array(
        'content' => $content,
        'tab' => $tab
    );
}



function comp_tabs($d, $side_or_top='top')
{

    // get attribute vals
    $atts = b_atts($d['atts']);

    // build class attribute
    $class = 'class="' . concat(array(
            'tabs ' . $side_or_top . "-tabs",
            $atts['class'],
        )) . '"';

    // build id attribute
    $id = $atts['id']?'id="' . $atts['id'] . '"':'tabs';

    // combine all attributes
    $all_atts = concat(array(
        $id,
        $class,
        $atts['other_atts']
    ));

    // create counter
    $c = 0;

    // if repeater has rows
    if ($d['tab']):

        // loop through tabs
        foreach($d['tab'] as $row):
            $tab = b_tab($row, $head_elem, $head_class, $atts['id'], $c++);

            $content .= $tab['content'];
            $tabs .= $tab['tab'];
        endforeach;


        ?>

        <div <?=$all_atts?>>
            <ul class="nav nav-tabs" role="tablist">
                <?php echo $tabs; ?>
            </ul>
            <div class="card card-body tab-content">
                    <?php echo $content; ?>
            </div>
        </div>

    <?php endif;
}



