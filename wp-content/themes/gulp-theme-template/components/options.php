<?php
/** OPTIONS.PHP
// ----- Version: 1.0
// ----- Released: 5.5.2020
// ----- Description: Declare build or formatting functions for options
// ----- ***ALL FUNCTIONS START WITH "opt_"
 * **/



// OUTPUT BACKGROUND
function opt_bg($bg)
{
    switch ($bg['style']) {
        case 'none':
            exit;
            break;
        case 'color':
            echo $bg['color'] . '-bg';
            break;
        case 'img':
            echo 'img-bg" style="url(' . wp_get_attachment_image_src($bg['img'], 'full') . ')';
            break;
    }
}