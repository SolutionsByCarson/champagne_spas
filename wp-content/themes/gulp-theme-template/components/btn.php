<?php
/** BTN.PHP
// ----- Version: 1.0
// ----- Released: 5.5.2020
// ----- Description: Declare build functions for buttons and button groups
 * **/


function b_btn( $link=null, $class=null, $txt=null, $icon=null ){

    // Set value defaults
    if ( !$link ){ $link = get_the_permalink(); }
    if ( !$txt ){ $txt = 'Learn More'; }
    if ( !$class ){ $class = 'btn-primary;'; }
    if ( !$icon ){ $icon = 'btn-primary;'; }
}


//  BUTTON GROUP
function b_btn_group($d)
{
    if ($d):
        ?>
        <div class="btn-group" role="group">
            <?php foreach ($d as $row): ?>
                <?php b_btn($row['btn']); ?>
            <?php endforeach; ?>
        </div>
    <?php
    endif;
}