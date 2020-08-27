<?php
/** TXT_LINK.PHP
// ----- Version: 1.0
// ----- Released: 6.3.2020
// ----- Description: Declare build functions for text links
// -----
 * **/

// --------------------------------------------------------
// ---------------- TEXT LINKS
// --------------------------------------------------------

/** MANUAL TEXT LINK ELEMENTS
$manual_txt_link = array(
'txt' => 'button text',
'link' => 'button link',
'link_target' => '_self',
'size' => 'btn-lg OR btn-sm',
'icon' => '<i class="fas fa-chevron-right"></i>',
);
elem_text_link($manual_txt_link);
 */

/**  LOOP USAGE
 *   1. Leave $d blank/null
 *   2. pass the link to $link
 *
 *   elem_txt_link(null,get_permalink());
 */

function elem_txt_link($d=null,$link=null)
{
    // if no txt-link is passed, use global txt-link default
    if ($link && $d==null){
        $d = get_field('txt_link','option');
    }

    // build txt-link classes
    $class = concat(array(
        'txt-link',
        $d['size'],
    ));
    ?>
    <a href="<?=$link?$link:$d['link']?>" class="<?=$class?>" target="<?=$d['link_target']?>"><?=$d['txt']?><?=$d['icon']?></a>
    <?php
}
