<?php
$val = array(
  isset($_SESSION['inputs']['libelle']) ? $_SESSION['inputs']['libelle'] : "",
  isset($_SESSION['inputs']['type']) ? $_SESSION['inputs']['type'] : "",
  isset($_SESSION['inputs']['contact']) ? $_SESSION['inputs']['contact'] : "",
  isset($_SESSION['inputs']['society']) ? $_SESSION['inputs']['society'] : "",
  isset($_SESSION['inputs']['phone']) ? $_SESSION['inputs']['phone'] : "",
  isset($_SESSION['inputs']['adress']) ? $_SESSION['inputs']['adress'] : "",
  isset($_SESSION['inputs']['complement']) ? $_SESSION['inputs']['complement'] : "",
  isset($_SESSION['inputs']['zip']) ? $_SESSION['inputs']['zip'] : "",
  isset($_SESSION['inputs']['city']) ? $_SESSION['inputs']['city'] : "",
  isset($_SESSION['inputs']['region']) ? $_SESSION['inputs']['region'] : ""
);
?>
<div class="row row-cols-1">
  <div class="col">
    <div class="card alert alert-light rounded-0 shadow-sm" role="alert">
      <div class="row">
        <p class="lead col-8">Ajoutez une adresse</p>
      </div>
      <hr class="m-1 py-1">
      <form action="./_add?action=adress" method="post">
        <div class="form-row">
          <div class="col-12 col-md-6 my-2">
            <?= "<input class='ndrtInput' type='text' name='libelle' placeholder='Libellé*' value='$val[0]'>" ?>
          </div>
          <div class="col-12 col-md-6 my-2">
            <select name="type" class="ndrtInput col">
              <option>Selectioner un type d' adresse *</option>
              <?= "<option value='" . ADRESSE::TYPE_F_ID . "' selected>" . ADRESSE::TYPE_F_NAME . "</option>" ?>
              <?= "<option value='" . ADRESSE::TYPE_L_ID . "'>" . ADRESSE::TYPE_L_NAME . "</option>" ?>
            </select>
          </div>
          <div class="col-12 col-sm-12 col-lg-4 my-2">
            <?= "<input class='ndrtInput' type='text' name='contact' placeholder='Nom de contact *' value='$val[2]'>" ?>
          </div>
          <div class="col-12 col-sm-6 col-lg-4 my-2">
            <?= "<input class='ndrtInput' type='text' name='society' placeholder='Entreprise *' value='$val[3]'>" ?>
          </div>
          <div class="col-12 col-sm-6 col-lg-4 my-2">
            <?= "<input class='ndrtInput' type='text' name='phone' placeholder='Téléphone *' value='$val[4]'>" ?>
          </div>
          <div class="col-12 my-2">
            <?= "<input class='ndrtInput' type='text' name='adress' placeholder='Adresse *' value='$val[5]'>" ?>
          </div>
          <div class="col-12 my-2">
            <?= "<input class='ndrtInput' type='text' name='complement' placeholder='Complément' value='$val[6]'>" ?>
          </div>
          <div class="col-4 my-2">
            <?= "<input class='ndrtInput' type='text' name='zip' placeholder='Code Postale *' value='$val[7]'>" ?>
          </div>
          <div class=" col-8 my-2">
            <?= "<input class='ndrtInput' type='text' name='city' placeholder='Ville *' value='$val[8]'>" ?>
          </div>
          <div class="col-12 col-md-6 my-2">
            <?= "<input class='ndrtInput' type='text' name='region' placeholder='Région' value='$val[9]'>" ?>
          </div>
          <div class="col-12 col-md-6 my-2">
            <select class="ndrtInput" name="country">
              <option selected>Pays *</option>
              <?= "<option value='" . ADRESSE::FRA_ID . "' selected>" . ADRESSE::FRA_NAME . "</option>" ?>
              <?= "<option value='" . ADRESSE::BEL_ID . "'>" . ADRESSE::BEL_NAME . "</option>" ?>
              <?= "<option value='" . ADRESSE::LUX_ID . "'>" . ADRESSE::LUX_NAME . "</option>" ?>
              <?= "<option value='" . ADRESSE::SWI_ID . "'>" . ADRESSE::SWI_NAME . "</option>" ?>
            </select>
          </div>
          <div class="col-sm-3 col-6">
            <input class="btn btn-danger w-100 <?= STYLE::NO_BDR_AND_RND ?>" type="reset" value="Vider" />
          </div>
          <div class="col-sm-3 col-6">
            <input class="btn btn-primary w-100 <?= STYLE::NO_BDR_AND_RND ?>" type="submit" value="Ajouter" />
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php
  $a = SELECT_ADRESSE();
  if (empty($a)) : ?>
    <div class="col">
      <div class="card alert alert-light rounded-0 shadow-sm p-0 m-0" role="alert">
        <p class="lead text-center p-2 text-uppercase p-0 m-0">Ici seront lister vos adresses</p>
      </div>
    </div>
  <?php else : ?>
    <div class="col">
      <?php ADRESSES_LIST($a, true); ?>
    </div>
  <?php endif ?>
</div>