<?php
$val = [
  isset($_SESSION['inputs']['username']) ? $_SESSION['inputs']['username'] : "",
  isset($_SESSION['inputs']['nom']) ? $_SESSION['inputs']['nom'] : "",
  isset($_SESSION['inputs']['prenom']) ? $_SESSION['inputs']['prenom'] : "",
  isset($_SESSION['inputs']['mail']) ? $_SESSION['inputs']['mail'] : ""
];
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
          <input type="password" class="ndrtInput" placeholder="Mot de passe *" name="password">
        </div>
        <div class="col-12 col-md-6 my-2">
          <input type="password" class="ndrtInput" placeholder="Comfirmation *" name="password2">
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