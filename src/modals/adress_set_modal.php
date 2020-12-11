<div class="modal fade bd-example-modal-md" id="editAdressModal<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-gold" id="exampleModalLabel">Modifié <b><?= $value->name ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-gold"><?= ICON::CROSS ?></span>
        </button>
      </div>
      <form id="editAdressForm<?= $value->id ?>" method="POST" class="" action="./_set?ad=adress&action=edit">
        <input type="text" value="<?= $value->id ?>" name="id" hidden />
        <div class="modal-body">
          <div class="row my-1">
            <div class="col">
              <input type="text" name="name" class="ndrtInput bg-transparent" value="<?= $value->name ?>" placeholder="Libellé adresse" />
            </div>
          </div>
          <div class="row my-1">
            <div class="col-12 col-md-6">
              <input type="text" name="client" class="ndrtInput bg-transparent" value="<?= $value->client ?>" placeholder="Nom du client" />
            </div>
            <div class="col-12 col-md-6">
              <input type="text" name="society" class="ndrtInput bg-transparent" value="<?= $value->society ?>" placeholder="Société" />
            </div>
          </div>
          <div class="row my-1">
            <div class="col">
              <input type="text" name="adresse" class="ndrtInput bg-transparent" value="<?= $value->adresse ?>" placeholder="Adresse" />
            </div>
          </div>
          <div class="row my-1">
            <div class="col">
              <input type="text" name="complement" class="ndrtInput bg-transparent" value="<?= $value->complement ?>" placeholder="complement" />
            </div>
          </div>
          <div class="row my-1">
            <div class="col-12 col-md-4">
              <input type="text" name="zip" class="ndrtInput bg-transparent" value="<?= $value->zip ?>" placeholder="Code postale" />
            </div>
            <div class="col-12 col-md-8">
              <input type="text" name="ville" class="ndrtInput bg-transparent" value="<?= $value->ville ?>" placeholder="Ville" />
            </div>
          </div>
          <div class="row my-1">
            <div class="col-12 col-md-6">
              <select name="pays" class="ndrtInput bg-transparent">
                <option value="<?= $value->idPays ?>" selected><?= $value->pays ?></option>
                <?php $req['pays'] = $value->idPays;
                foreach ($ADRESSE->fetchCountry($req) as $pays) : ?>
                  <option value="<?= $pays->id ?>"><?= $pays->name ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="col-12 col-md-6">
              <input type="text" name="region" class="ndrtInput bg-transparent" value="<?= $value->region ?>" placeholder="Région" />
            </div>
          </div>
          <div class="row my-1">
            <div class="col">
              <input type="text" name="phone" class="ndrtInput bg-transparent" value="<?= $value->phone ?>" placeholder="Téléphone" />
            </div>
          </div>
        </div>

        <div class="modal-footer bg-dark">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success" onclick="valideForm(<?= $value->id ?>)">Enregistrer modification</button>
        </div>
      </form>

    </div>
  </div>
</div>
