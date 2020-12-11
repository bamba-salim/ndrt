<?php
$v = array(
  isset($_SESSION['inputs']['name']) ? $_SESSION['inputs']['name'] : '',
  isset($_SESSION['inputs']['detail']) ? $_SESSION['inputs']['detail'] : '',
  isset($_SESSION['inputs']['img']) ? $_SESSION['inputs']['img'] : ''
);
?>
<section class="container my-3 bg-white">
  <div class="col-12 col-md-6 mx-auto my-2">
    <h1 class="text-center text-gold h1 p-5 text-uppercase">AJOUTER UNE CATéGORIE</h1>
  </div>
  <div class="col-md-6 col-12 mx-auto my-2 p-0">
    <form class="bg-transparent" method="POST" action="./_add?action=category">
      <div class="row">
        <div class="col-12 p-1 my-2">
          <input type="text" class="ndrtInput  bg-transparent" placeholder="Nom" name="name" value="<?= trim($v[0]) ?>" />
        </div>
        <div class="col-12 p-1 my-2">
          <input type="text" class="ndrtInput  bg-transparent" placeholder="Détails" name="detail" value="<?= trim($v[1]) ?>" />
        </div>
        <div class="col-12 p-1 my-2">
          <select class="ndrtInput border-top-0" aria-placeholder="Catégorie" name="type">
            <option selected>Type</option>
            <?= "<option value='" . CATEGORY::CAT_ID . "'>" . CATEGORY::CAT_NAME . "</option>" ?>
            <?= "<option value='" . CATEGORY::COL_ID . "'>" . CATEGORY::COL_NAME . "</option>" ?>
            <?= "<option value='" . CATEGORY::ALT_ID . "'>" . CATEGORY::ALT_NAME . "</option>" ?>
          </select>
        </div>
        <div class="col-12 p-1 my-2">
          <input type="text" class="ndrtInput  bg-transparent" placeholder="Image" name="image" value="<?= trim($v[2]) ?>" />
        </div>
        <div class="col-6"><a href="./admin?ad=category" class="btn btn-danger rounded-0 w-100">Annuler</a></div>
        <div class="col-6">
          <input type="submit" value="Ajouter" class="btn btn-primary rounded-0 w-100" />
        </div>
      </div>
    </form>
  </div>
</section>
<?php unset($_SESSION['errors'], $_SESSION['inputs'], $_SESSION['success']) ?>