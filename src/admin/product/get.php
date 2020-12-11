<?php

  $PRODUCT = new PRODUCT();

if (isset($_GET['ref'])) :
  $test = "", $limit = "", $rand = "", $idExcept = ""
  $p = $PRODUCT->getProductList($product);
  var_dump($p);

  include('./src/category/product_page.php');
else :
  $p = $PRODUCT->getProductList();
  echo "<div class='container'>";
  foreach ($p as $value) :
?>
    <div class="card alert alert-light rounded-0 shadow-sm my-3">

      <div class="row">
        <div class="col-4 col-md-3 col-lg-2 p-0 m-0">
          <figure class="m-0 p-0">
            <div class="gallery-selected">
              <a href="./admin?root=product&ref=<?= $value->ref ?>">
                <?= "<img src='{$value->img}' alt='{$value->img}'/>" ?>
              </a>
            </div>
          </figure>
        </div>
        <div class="col row p-0 m-0">
          <!-- info -->
          <div class="col-12 row p-0 m-0">
            <div class="col-7 col-sm-8 col-md-10">
              <p class="p-2 m-0"><a href="./admin?root=product&ref=<?= $value->ref ?>" class="text-decoration-none text-dark"><?= $value->name ?></a></p>
            </div>
            <div class="col p-0 m-0">

            </div>
          </div>
          <div class="col-12 p-0 m-0 row">

          </div>
        </div>
      </div>
      <a href='./admin?root=product&ref=<?= $value->ref ?>' class='btn btn-secondary'>view</a>
      <a href='./admin?root=product&ref=<?= $value->ref ?>&action=set' class='btn btn-secondary'>set</a>
      <a href='./admin?root=product&ref=<?= $value->ref ?>&action=del' class='btn btn-secondary'>del</a>
    </div>
<?php
  endforeach;
  echo "</div>";
endif;
