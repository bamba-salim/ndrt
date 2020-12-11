<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-0 border-0">
      <div class="modal-header bg-dark rounded-0">
        <h5 class="modal-title text-gold" id="changePasswordLabel">Changer de mot de passe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-gold"><?= ICON::CROSS ?></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./profile?ref=<?= $u[0]->ref ?>&action=account&update=pass" method="post">
          <div class="row">
            <div class="col-12 my-2">
              <input type="text" class="ndrtInput" name="oldPass" placeholder="Ancien mot de passe *" />
            </div>
            <div class="col-12 my-2">
              <input type="password" class="ndrtInput" name="newPass1" placeholder="Nouveau mot de passe *" />
            </div>
            <div class="col-12 my-2">
              <input type="password" class="ndrtInput" name="newPass2" placeholder="Comfirmation nouveau mot de passe *" />
            </div>
            <div class="col-lg-6 col-12">
              <?= "<a data-dismiss='modal' class='btn btn-danger text-decoration-none text-white col-12 my-2 rounded-0' style='text-decoration: underline'>Annuler</a>" ?>
            </div>
            <div class="col-lg-6 col-12">
              <?= "<input type='submit' class='btn btn-primary col-12 my-2 rounded-0' value='Modifier mot de passe' />" ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>