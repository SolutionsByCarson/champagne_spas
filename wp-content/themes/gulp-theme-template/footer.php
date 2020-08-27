</div>
<!--END CONTENT-->

<!--START FOOTER-->
<?php
if (get_field('footer_code', 'option')) { the_field('footer_code', 'option'); }
wp_footer();
?>

<!--Print Popups-->
<?php $modals = get_field('modals'); ?>
<?php if($modals):?>
<?php foreach ($modals as $d): ?>
<div class="modal fade" id="<?=$d['id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header white bg-primary">
                <h5 class="modal-title"><?=$d['head']?></h5>
                <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-window-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?=$d['cont']?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<div class="modal fade" id="site_disclosures" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header white bg-primary">
                <h5 class="modal-title"><?=the_field('disclosure_popup_header');?></h5>
                <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-window-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?=the_field('disclosure_popup_content');?>
            </div>
        </div>
    </div>
</div>

<footer>

    <!-- Bottom Bar / Copyright -->
    <section class="white bg-xd-primary" id="bottom-bar">
        <div class="container">
            <div class="row">
                <div class="col col-12 text-center mb-3" id="copyright">
                    <span class="x-small">© Copyright <?php echo date('Y') . " - " . get_field('site_copyright'); ?></span>
                </div>
                <div class="col col-12 text-center l-primary" id="disclosures">
                    <a class="txt-link small l-primary" data-toggle="modal" data-target="#site_disclosures">
                        <?=the_field('disclosure_menu_text'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</footer>



<!--END PAGE, BODY, & HTML-->
</div>
</body>
</html>