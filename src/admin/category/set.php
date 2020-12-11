<?php
$CATEGORY = new CATEGORY;
$category = $CATEGORY->getCatById($_GET['id']);
?>
<section class="container mt-3">
  <div class="row row-cols-1 p-0 m-0">
    <div class="col bg-dark text-white p-0 m-0">
      <h1 class="text-center w-100 h3 m-0 p-3">Modifié "<?= ucfirst($category[0]->name) ?>"</h1>
    </div>
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
          <form method="POST" action="./_set?ad=category&id=<?= $category[0]->id ?>" class="row row-cols-1">
            <div class="col-12 p-1 my-1">
              <input type="" class="ndrtInput bg-transparent" placeholder="Nom" name="categoryId" value="<?= $category[0]->id ?>" hidden/>
            </div>
            <div class="col-12 p-1 my-1">
              <input type="text" class="ndrtInput bg-transparent" placeholder="Nom" name="categoryName" value="<?= ucfirst($category[0]->name) ?>" />
            </div>
            <div class="col-12 p-1 my-1">
              <input type="text" class="ndrtInput bg-transparent" placeholder="Détails" name="categoryDetail" value="<?= ucfirst($category[0]->detail) ?>" />
            </div>
            <div class="col-12 p-1 my-1">
              <input type="text" class="ndrtInput bg-transparent" placeholder="Liens Image" name="categoryImage" value="<?= $category[0]->img ?>" />
            </div>
            <div class="col-12 p-1 my-1">
              <div class="row row-cols-2 mx-auto">
                <div class=""> <a href="./admin?ad=category" class="btn btn-danger rounded-0 w-100 m-0"> Annuler</a></div>
                <div class=""> <button class="btn btn-success rounded-0 w-100 m-0" type="submit">Save</button></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>