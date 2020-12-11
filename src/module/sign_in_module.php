<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-0 border-0">
      <div class="modal-header bg-dark rounded-0">
        <?= "<h5 class='text-gold text-uppercase'>" . LOG::IN_MSG . "</h5>" ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-gold"><?= ICON::CROSS ?></span>
        </button>
      </div>
      <div class="modal-body">
        <?php FORM_LOGIN() ?>
      </div>
    </div>
  </div>
</div>