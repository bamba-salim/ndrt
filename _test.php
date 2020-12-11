<?php
require './config/config.php';
$ptil = 'PAGE DE TEST';
include_once('./inc/head.inc.php');
include_once('./inc/header.inc.php');
?>
<main class="container">
  <section>
    <h1 class="text-center"><?= $ptil  ?></h1>
  </section>
  <section>
    <?php debug() ?>
  </section>

  <?php
  $prod = new stdClass();
  $prod->id = 20;
  $prod->qty = 2;
  $ORDER->updateProductQty($prod);

  var_dump($ADRESSE->ref)
  ?>

  <section class="my-3">
    <form action="./_add?action=test" method="post" enctype="multipart/form-data">
      <input type="file" name="upFile" />
      <input type="submit" name="submit" />
    </form>
  </section>

</main>
<?php
isset($_SESSION['errors']) ? var_dump($_SESSION['errors']) : "";
unDebug();
$script = './js/js-test.js';
include_once('./inc/footer.inc.php');


?>