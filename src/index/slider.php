<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">  
    <div class="carousel-item active" data-interval="<?= $CATEGORY::SLIDE ?>">
      <figure class="ndrtSlider">
        <div class="ndrtContainer">
          <img src="<?= $c[0]->img ?>" alt="<?= $c[0]->name ?>">
          <figcaption onclick="window.open('./category?id=<?= $c[0]->id ?>', '_self')">
            <p class="<?= STYLE::SLIDER_TEXT ?>"><?= $c[0]->name?><br /><small class="h6">(<?= $c[0]->detail ?>)</small></p>
          </figcaption>
        </div>
      </figure>
    </div>
    <?php foreach ($c as $value) : ?>
      <div class="carousel-item" data-interval="<?= $CATEGORY::SLIDE ?>">
        <figure class="ndrtSlider">
          <div class="ndrtContainer">
            <img src="<?= $value->img?>" alt="<?= $value->name ?>">
            <figcaption onclick="window.open('./category?id=<?= $value->id ?>', '_self')">
              <p class="<?= STYLE::SLIDER_TEXT ?>"><?= $value->name ?><br /><small class="h6">(<?= $value->detail ?>)</small></p>
            </figcaption>
          </div>
        </figure>
      </div>
    <?php endforeach ?>
  </div>
  <div>
    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
  </div>
  <div>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>