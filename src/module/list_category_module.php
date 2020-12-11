<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 my-2">
  <?php
  foreach ($products as $value) { ?>
    <div class="col mb-1">
      <div class="card h-100 border-0 my-2 ndrt-hover rounded-0 p-0" onClick="window.location='./product?ref=<?= $value->ref ?>';">
        <figure class="m-0 p-0">
          <div class="gallery-selected m-0">
            <img src="<?= $value->img ?>" alt="<?= $value->name ?>" class="" />
          </div>
        </figure>
        <?=
          "
            <div class='p-1 m-0'>
              <p class='p-0 m-0 h4'>" . ucfirst($value->name) . "</p>
              <p class='small p-0 m-0 h6'><em>" . ucfirst($value->col) . "</em></p>
              <p class='text-right text-gold font-weight-bold p-0 my-2'>" . number_format($value->price, 2, ',', ' ') . " €</p>
            </div>
          "
        ?>
      </div>
    </div>
  <?php } ?>
</div>