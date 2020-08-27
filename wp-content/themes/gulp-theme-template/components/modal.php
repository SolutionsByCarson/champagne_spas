<?php
/** MODAL.PHP
// ----- Version: 1.0
// ----- Released: 4.5.2020
// ----- Description: SBC Modal
// ----- Instructions: call "sbc_modal(...)" to print modal
**/

function sbc_modal($id, $size='lg', $title, $body ){
?>
    <!-- Modal -->
    <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="<? echo $id; ?>" aria-hidden="true">
        <div class="modal-dialog modal-<?php echo $size; ?>" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $title; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $body; ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
