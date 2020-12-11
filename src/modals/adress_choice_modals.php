<?php
$ADRESSE = new ADRESSE();
$user = new stdClass();
if (isset($_SESSION['user']->id)) {
  $user->user = $_SESSION['user']->id;
  $user->actived = true;
  $adresses = $ADRESSE->getAdresseList($user);
}

?>

<div class="modal fade bd-example-modal-md" id="chooseAdress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-gold" id="exampleModalLabel">Choisissez vos adresse</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-gold"><?= ICON::CROSS ?></span>
        </button>
      </div>
      <form method="POST" class="" action="./_add?action=order">
        <div class="modal-body">
          <div class="row my-1">
            <div class="col-6">
              <select name="facturation" id="facturation" class="form-control" onchange="getAdressFac()" required>
                <option value="">Selectionner une adresse de facturation</option>
                <?php foreach ($adresses as $adr) : ?>
                  <option value="<?= $adr->id ?>"><?= $adr->name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-6">
              <select name="livraison" id="livraison" class="form-control" onchange="getAdressLiv()" required>
                <option value="" >Selectionner une adresse de livraison</option>
                <?php foreach ($adresses as $adr) : ?>
                  <option value="<?= $adr->id ?>"><?= $adr->name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer bg-dark">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Comfimer commande</button>
        </div>
      </form>

    </div>
  </div>
</div>