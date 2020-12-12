<?php

function FORM_LOGIN()
{
  $mail = isset($_SESSION['inputs']['mail']) ? $_SESSION['inputs']['mail'] : ''
?>
  <form action="./_log?action=in" method="POST">
    <div class="form-row">
      <div class="col-12 my-2">
        <input type="text" class="ndrtInput" name="login" placeholder="Identifiaint de connexion" value="<?= $mail ?>">
      </div>
      <div class="col-12 my-2">
        <input type="password" class="ndrtInput" name="password" placeholder="Mot de passe">
      </div>
      <div class="col-lg-6 col-12">
        <?= "<button type='submit' class='btn btn-primary col-12 my-2 rounded-0'>" . ucfirst(LOG::IN_NAME) . "</button>" ?>
      </div>
      <div class="col-lg-6 col-12 small d-flex align-items-center">
        <?= " <a href='./login?sign=up' class='text-secondary small' style='text-decoration: underline'>Vous n'avez pas de compte? " . ucfirst(LOG::UP_ALT)  . ".</a>" ?>
      </div>
    </div>
  </form>
<?php
}



function MODAL_LOGIN()
{
?>
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
<?php
}

function LOGIN_SIGNUP()
{
  $val = array(
    isset($_SESSION['inputs']['username']) ? $_SESSION['inputs']['username'] : "",
    isset($_SESSION['inputs']['nom']) ? $_SESSION['inputs']['nom'] : "",
    isset($_SESSION['inputs']['prenom']) ? $_SESSION['inputs']['prenom'] : "",
    isset($_SESSION['inputs']['mail']) ? $_SESSION['inputs']['mail'] : ""
  );
?>
  <div class="container">
    <div class="h-100">
      <form method="POST" action="./_add?action=user">
        <div class="form-row">
          <div class="col-12 col-lg-4  my-2">
            <input type="text" class="ndrtInput" placeholder="Pseudo *" name="username" value="<?= $val[0] ?>" maxlength="20">
          </div>
          <div class="col-12 col-md-6 col-lg-4 my-2">
            <input type="text" class="ndrtInput" placeholder="Nom *" name="nom" value="<?= $val[1] ?>" maxlength="20">
          </div>
          <div class="col-12 col-md-6 col-lg-4 my-2">
            <input type="tel" class="ndrtInput" placeholder="Prenom *" name="prenom" value="<?= $val[2] ?>" maxlength="20">
          </div>
          <div class="col-12 my-2">
            <input type="text" class="ndrtInput" placeholder="Mail *" name="mail" value="<?= $val[3] ?>">
          </div>
          <div class="col-12 col-md-6 my-2">
            <input type="password" class="ndrtInput" placeholder="Mot de passe *" name="passFST">
          </div>
          <div class="col-12 col-md-6 my-2">
            <input type="password" class="ndrtInput" placeholder="Comfirmation *" name="passSND">
          </div>
          <div class='col-md-6 col-12'>
            <button type='submit' class='btn btn-primary col-12 my-2 rounded-0'><?= ucfirst(LOG::UP_NAME) ?></button>
          </div>
          <div class="col-md-6 col-12 small d-flex align-items-center">
            <a href='./login?sign=in' class='text-secondary small' style='text-decoration: underline'>Vous avez un compte ? <?= ucfirst(LOG::IN_ALT) ?></a>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php
}

function LOGIN_SIGNIN()
{
?>
  <section class="mx-auto">
    <div class="container">
      <div class="h-100 justify-content-center">
        <?php FORM_LOGIN() ?>
      </div>
    </div>
  </section>
<?php
}

function NOT_FOUND()
{
?>
  <div class='jumbotron jumbotron-fluid my-3 bg-white text-gold text-center'>
    <h1 class='display-4'>OUPS</h1><img src='" . IMG::LOST . "' alt='404' class='w-50'>
    <p class='text-gold text-center display-4'>IL SEMBLE QU'IL N'Y EST RIEN ICI</p>
  </div>
<?php
}

function BACK_TO_MAIL_LIST()
{
?>
  <div class="text-center conatainer">
    <a href="./admin?root=mails" class="p-2 w-50 btn-danger text-decoration-none text-uppercase">Retouner à la liste</a>
  </div>
<?php
}





function CLOSE_WINDOW()
{
?>
  <div class='container my-5 text-center'>
    <a class='btn btn-danger rounded-0 w-50 text-white' onclick='window.close()'>Fermer la fenêtre</a>
  </div>;
<?php
}


function debug()
{
  if (isset($_SESSION['errors'])) :
?>
  <div class='container p-0'>
    <ul class='list-group'>
      <?php foreach ($_SESSION['errors'] as $value) : ?>
        <?= "<li class='small list-group-item list-group-item-danger border-0 rounded-0'>{$value}</li>" ?>
      <?php endforeach; ?>
    </ul>
  </div>
<?php elseif (isset($_SESSION['success'])) : ?>
  <div class='col-lg-6 col-12 p-0 mx-auto'>
    <ul class='list-group'>
      <?= "<li class='small list-group-item list-group-item-success border-0 text-center rounded-0'>{$_SESSION['success']}</li>" ?>
    </ul>
  </div>
<?php
  endif;
}

function unDebug()
{
  unset($_SESSION['errors'], $_SESSION['inputs'], $_SESSION['success'], $_SESSION['object']);
}
