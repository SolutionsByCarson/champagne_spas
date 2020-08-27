<?php
/** FEATURED-CARD.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: SBC Featured Card -- Use card as link
// ----- Instructions: call "sbc_featured_card(...)" to print featured card
**/

// featured card build function
function sbc_featured_card($id=null, $img=null, $title=null, $description=null, $link=null) {
    if($id != null){
        $img = get_the_post_thumbnail($id, 'card-img');
        $title = get_title($id);
        $description =  get_the_excerpt($id);
        $link = get_permalink($id);
    }
?>
    <a class="featured-card-link" href="<?php echo $link; ?>">
        <div class="card featured-card">
            <?php echo $img; ?>
            <div class="card-body">
                <h4 class="card-title"><?php echo $title; ?></h4>
                <p class="card-text"><?php echo $description; ?></p>
            </div>
        </div>
    </a>

<?php
}

