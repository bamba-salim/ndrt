<?php
if(!isset($_GET['action'])):
  header("location: ./admin?root=product");
endif;
$reqSQL = "SELECT id, name from category";
$cat = DB()->fetch($reqSQL . ' WHERE type = ' . CATEGORY::CAT_ID);
$col = DB()->fetch($reqSQL . ' WHERE type = ' . CATEGORY::COL_ID);
$alt = DB()->fetch($reqSQL . ' WHERE type = ' . CATEGORY::ALT_ID);
$pv = array(
  isset($_SESSION['inputs']['pLibe']) ? $_SESSION['inputs']['pLibe'] : '',
  isset($_SESSION['inputs']['pPrice']) ? $_SESSION['inputs']['pPrice'] : '',
  isset($_SESSION['inputs']['pColor']) ? $_SESSION['inputs']['pColor'] : '',
  isset($_SESSION['inputs']['pQTY']) ? $_SESSION['inputs']['pQTY'] : '',
  isset($_SESSION['inputs']['pImg']) ? $_SESSION['inputs']['pImg'] : '',
  isset($_SESSION['inputs']['pDescr']) ? $_SESSION['inputs']['pDescr'] : '',
  isset($_SESSION['inputs']['pCompo']) ? $_SESSION['inputs']['pCompo'] : '',
  isset($_SESSION['inputs']['pCare']) ? $_SESSION['inputs']['pCare'] : ''
);
?>
<script>
  function limitStop(dText, idmes) {
    var inputVal = dText.value;
    var limit = dText.maxLength;
    var length = inputVal.length;
    $(idmes).html(length + "/" + limit);
    if (inputVal.length >= limit) {
      $(idmes).addClass("text-danger");
      $(dText).addClass("border-danger");
      $(idmes).html(length + "/" + limit);
    } else {
      $(dText).removeClass("border-danger");
      $(idmes).html(length + "/" + limit);
      $(idmes).removeClass("text-danger");
    }
  }
</script>
<section class="container my-3 bg-white">
  <div class="col-12 col-md-6 mx-auto my-2">
    <h1 class="text-center text-gold h1 p-5 text-uppercase">AJOUTER UN article</h1>
  </div>
  <div class="col-12 col-md-6 mx-auto my-2">
    <form class="bg-transparent" method="POST" action="_add?action=prod">
      <div class="row">
        <div class="col-12 p-1 m-0">
          <input onkeyup="javascript:limitStop(this, Name)" maxlength="20" type="text" class="ndrtInput bg-transparent" placeholder="Libellé" name="name" value="<?= $pv[0] ?>" />
          <p id="Name" class="small px-3 text-right">0/20</p>
        </div>
        <div class="col-12 col-lg-4 p-1 m-0">
          <input type="text" class="ndrtInput bg-transparent" placeholder="Prix" name="price" value="<?= $pv[1] ?>" />
        </div>
        <div class="col-12 col-lg-4 p-1 m-0">
          <input type="text" class="ndrtInput bg-transparent" placeholder="Couleur" name="color" value="<?= $pv[2] ?>" />
        </div>
        <div class="col-12 col-lg-4 p-1 m-0">
          <input type="number" class="ndrtInput bg-transparent" placeholder="Quantité" min="0" name="qty" value="<?= $pv[3] ?>" />
        </div>
        <div class="col-12 p-1 m-0">
          <input type="text" class="ndrtInput bg-transparent" placeholder="Img" name="img" value="<?= $pv[4] ?>" />
        </div>
        <div class="col-12 col-lg-4 p-1 m-0">
          <select class="ndrtInput border-top-0" aria-placeholder="Collection" name="col">
            <option value='NULL' selected>Collection</option>
            <?php foreach ($col as $value) : echo "<option value='$value->id'>" . ucfirst($value->name) . "</option>";
            endforeach; ?>
          </select>
        </div>
        <div class="col-12 col-lg-4 p-1 m-0">
          <select class="ndrtInput border-top-0" aria-placeholder="Catégorie" name="cat">
            <option value='NULL' selected>Catégorie</option>
            <?php foreach ($cat as $value) : echo "<option value='$value->id'>" . ucfirst($value->name) . "</option>";
            endforeach; ?>
          </select>
        </div>
        <div class="col-12 col-lg-4 p-1 m-0">
          <select class="ndrtInput border-top-0" aria-placeholder="Sous-Catégorie" name="alt">
            <option value='NULL' selected>Sous-Catégorie</option>
            <?php foreach ($alt as $value) : echo "<option value='$value->id'>" . ucfirst($value->name) . "</option>";
            endforeach; ?>
          </select>
        </div>
        <div class="col-12 p-1 m-0">
          <textarea onkeyup="javascript:limitStop(this, pdescr)" class="ndrtInput" name="description" placeholder="Description *" maxlength="300"><?= $pv[5] ?></textarea>
          <p id="pdescr" class="small px-3 text-right">0/300</p>
        </div>
        <div class="col-12 p-1 m-0">
          <textarea onkeyup="javascript:limitStop(this, pcompo)" class="ndrtInput" name="composition" placeholder="Composition *" maxlength="150"><?= $pv[6] ?></textarea>
          <p id="pcompo" class="small px-3 text-right">0/150</p>
        </div>
        <div class="col-6 p-1 m-0"><a href="./admin?root=product" class="btn btn-danger rounded-0 w-100">Annuler</a></div>
        <div class="col-6 p-1 m-0"><button class="btn btn-success rounded-0 w-100" type="submit">Ajouter</button></diV>

      </div>

    </form>
  </div>
</section>

<?php unset($_SESSION['errors'], $_SESSION['inputs'], $_SESSION['succes']) ?>