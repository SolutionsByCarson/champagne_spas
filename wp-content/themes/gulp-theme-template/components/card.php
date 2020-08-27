<?php
/** CARD.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: SBC Card
// ----- Instructions: call "sbc_card(...)" to print card
**/





// cards fill the width and height of their container
function sbc_card($id=null, $img=null, $head=null, $desc=null, $link=null){
    if($id != null){
        $img = get_the_post_thumbnail($id, 'card-img', array( 'class' => 'img card-img' ));
        $head = get_the_title($id);
        $desc =  get_the_excerpt($id);
        $link = get_permalink($id);
    }

?>
    <div class="col col-12 col-sm-6 col-md-4">
        <div class="card standard-card">
            <?php echo $img; ?>
            <div class="card-body">
                <h4 class="head card-head"><?php echo $head; ?></h4>
                <p class="desc card-desc"><?php echo $desc; ?></p>
                <a href="<?php echo $link; ?>" class="card-link">Learn More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>


<?php
}