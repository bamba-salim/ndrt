<?php
$CATEGORY = new CATEGORY;
$category = $CATEGORY->getCatById($_GET['id']);
?>

<section class="container mt-3">
  <div class="row row-cols-1 p-0 m-0">

    <div class="col p-0 m-0">
      <div class="row row-cols-1 row-cols-md-2 p-0 m-0">
        <div class="col ">
          <figure>
            <div class="gallery-selected">
              <?php if ($category[0]->img != null) { ?>
                <img src="<?= $category[0]->img ?>" alt="<?= $category[0]->name ?>" class="" />
              <?php } else { ?>
                <h1><?= ucfirst($category[0]->name) ?></h1>
              <?php } ?>
            </div>
          </figure>
        </div>
        <div class="col p-0 m-0">
          <form method="POST" action="./_del?ad=category" class="row row-cols-1">
            <div class="col-12 p-1 my-1">
              <input type="" class="ndrtInput bg-transparent" placeholder="Nom" name="categoryId" value="<?= $category[0]->id ?>" hidden/>
            </div>

            <p class="h1 text-center p-5">Voulez vous vraiment Supprimer <?=ucfirst($category[0]->name) ?></p>
            <div class="col-12 p-1 my-1">
              <div class="row row-cols-2 mx-auto">
                <div class=""> <a href="./admin?ad=category" class="btn btn-info rounded-0 w-100 m-0"> Annuler</a></div>
                <div class=""> <button class="btn btn-danger rounded-0 w-100 m-0" type="submit">Supprimer</button></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>