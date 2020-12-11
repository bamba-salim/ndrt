<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-0 border-0">
      <div class="modal-header bg-dark rounded-0">
        <?= "<h5 class='text-gold text-uppercase'>" . LOG::IN_MSG . "</h5>" ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-gold"><?= ICON::CROSS ?></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-3">
            <div class="nav flex-column nav-pills" id="login-tab" role="tablist" aria-orientation="vertical">
              <a class="<?= STYLE::MAIL_LINK_MENU ?> active" id="sign-in-tab" data-toggle="pill" href="#sign-in" role="tab" aria-controls="sign-in" aria-selected="true">Se conneceter</a>
              <a class="<?= STYLE::MAIL_LINK_MENU ?>" id="sign-up-tab" data-toggle="pill" href="#sign-up" role="tab" aria-controls="sign-up" aria-selected="false">S'inscrire</a>
            </div>
          </div>
          <div class="col-9">
            <div class="tab-content" id="login-tabContent">
              <div class="tab-pane fade show active" id="sign-in" role="tabpanel" aria-labelledby="sign-in-tab">
                <form action="./_log?action=in" method="POST">
                  <div class="form-row">
                    <div class="col-12 my-2">
                      <input type="text" class="ndrtInput" name="login" placeholder="Identifiaint de connexion">
                    </div>
                    <div class="col-12 my-2">
                      <input type="password" class="ndrtInput" name="password" placeholder="Mot de passe">
                    </div>
                    <div class="col-lg-6 col-12">
                      <button type='submit' class='btn btn-success col-12 my-2 rounded-0'>Se connecter</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane fade" id="sign-up" role="tabpanel" aria-labelledby="sign-up-tab">
                <form method="POST" action="./_add?action=user">
                  <div class="form-row">
                    <div class="col-12 col-lg-4  my-2">
                      <input type="text" class="ndrtInput" placeholder="Pseudo *" name="username" maxlength="20" />
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 my-2">
                      <input type="text" class="ndrtInput" placeholder="Nom *" name="nom" maxlength="20" />
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 my-2">
                      <input type="tel" class="ndrtInput" placeholder="Prenom *" name="prenom" maxlength="20" />
                    </div>
                    <div class="col-12 my-2">
                      <input type="text" class="ndrtInput" placeholder="Mail *" name="mail" />
                    </div>
                    <div class="col-12 col-md-6 my-2">
                      <input type="password" class="ndrtInput" placeholder="Mot de passe *" name="password" />
                    </div>
                    <div class="col-12 col-md-6 my-2">
                      <input type="password" class="ndrtInput" placeholder="Comfirmation *" name="password2" />
                    </div>
                    <div class='col-md-6 col-12'>
                      <button type='submit' class='btn btn-success col-12 my-2 rounded-0'>S'inscire</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>