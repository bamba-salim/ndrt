<div class="col-12 mx-auto p-0">
  <div class="card rounded-0 m-0 p-0 border-0">
    <div class="card-header p-0 bg-transparent p-2">
      <div class="row p-2 mt-1">
        <div class="col-12 col-md-3 col-lg-2 text-uppercase"><?= $value->date ?></div>
        <div class="col-12 col-md-5 col-lg-3 text-uppercase">
          <a href="./order?ref=<?= $value->ref ?>"><?= $value->ref ?></a>
        </div>
        <div class="col-6 col-md-2  text-uppercase text-right">
          <p><?= $value->qty ?></p>
        </div>
        <div class="col-6 col-md-2 col-lg-2 text-uppercase text-right">
          <p><?= number_format($value->total, 2, ',', ' ')  ?> €</p>
        </div>
        <div class="col text-center p-2">
          <div class="progress mx-auto">
            <?php $ORDER->progress($value->status) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>