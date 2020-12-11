  <div class="row row-cols-1 row-cols-lg-2 p-0">
    <div class="col">
      <div class="<?= STYLE::PRODUCT ?>">
        <figure>
          <div class="gallery-selected">
            <?= "<img src='{$p->img}' alt='{$p->name}'/>" ?>
          </div>
        </figure>
      </div>
    </div>
    <div class="col">
      <div class="<?= STYLE::PRODUCT ?>">
        <div class="card-body">
          <h2 class="card-title text-gold h3"><?= ucfirst($p->name) ?></h2>
          <p class="h3 text-gold font-weight-bolder"><?= $PRODUCT->PRICE($p->price)->currency ?></p>
          <?= "<p>{$p->color} - {$p->ref}</p>" ?>
          <p class="small"><?= $p->composition ?></p>
          <p class="small"><?= $p->description ?></p>
          <div class="mx-auto text-lowercase">
            <a href="./category?id=<?= $p->idCat ?>" class="badge badge-gold text-white rounded-0"><?= $p->cat ?> </a>
            <a href="./category?id=<?= $p->idAlt ?>" class="badge badge-gold text-white rounded-0"><?= $p->alt ?> </a>
            <a href="./category?id=<?= $p->idCol ?>" class="badge badge-gold text-white rounded-0"><?= $p->col ?> </a>
          </div>
        </div>

        <?php if (!isset($_GET['root'])) : ?>
          <div class="card-footer bg-transparent border-0 mb-2 p-0">
            <form action="./_add?action=cart&ref=<?= $p->ref ?>" method="POST">
              <div class="row w-75 mx-auto p-0 m-0">
                <div class="col-4 col-md-3 p-0 m-0">

                  <input type="number" name="qty" id="qty" class="ndrtInput bg-transparent" min=1 max=12 value=1 />
                </div>
                <div class="col-8 col-md-9 p-0 m-0">
                  <input type="submit" class="btn btn-gold text-white rounded-0 w-100" value="Ajouter au panier" />
                </div>
              </div>
            </form>
          </div>

        <?php else : ?>
          <div class="card-footer bg-transparent border-0 mb-2 p-0">
            <a href="./admin?root=product&ref=<?= $_GET['ref'] ?>&action=set" class="btn btn-secondary">set</a>
            <a href="./admin?root=product&ref=<?= $_GET['ref'] ?>&action=del" class="btn btn-secondary">del</a>
            <a href='./admin?root=product' class='btn btn-secondary'>retout à la liste</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>