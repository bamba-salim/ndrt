<?php $CATEGORY = new CATEGORY() ?>

<section class="my-3 container">
  <div class="row row-cols-1 row-cols-lg-3">
    <section class="col">
      <?php $CATEGORY->showCategory($CATEGORY::PRINCIPAL) ?>
    </section>
    <section class="col">
      <?php $CATEGORY->showCategory($CATEGORY::COLLECTION) ?>
    </section>
    <section class="col">
      <?php $CATEGORY->showCategory($CATEGORY::SECONDAIRE) ?>
    </section>
  </div>
</section>