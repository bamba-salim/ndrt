<div class="row row-cols-md-2 row-cols-lg-4">
  <?php foreach ($c as $value) : ?>
    <div class="card p-1 rounded-0 border-0 bg-transparent m-0 ndrt-hover" onclick="window.open('./category?id=<?= $value->id ?>', '_self')">
      <figure class="m-0 p-0">
        <div class="gallery-selected">
          <img src="<?= $value->img ?>" alt="<?= $value->name ?>" />
        </div>
      </figure>
      <div class="p-0 p-1 text-gold text-center">
        <p class='h5 font-weight-bold'><?= strtoupper($value->name) ?></hp>
          <p class='small'>(<?= strtoupper($value->detail) ?>)</p>
      </div>
    </div>
  <?php endforeach ?>
</div>