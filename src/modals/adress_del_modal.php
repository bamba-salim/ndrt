<div class="modal fade bd-example-modal-md" id="deleteAdressModal<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-gold">
        <h5 class="modal-title" id="exampleModalLabel">Supprimer <b><?= $value->name ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-gold"><?= ICON::CROSS ?></span>
        </button>
      </div>
      <div class="modal-body text-center">
        Êtes vous sur de vouloir supprimer votre adresse <b>"<?= $value->name ?>"</b> ?
      </div>
      <div class="modal-footer bg-dark">
        <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" onclick="comfirmDeleteAdresse(<?= $value->id ?>)">Supprimer</button>
      </div>
    </div>
  </div>
</div>