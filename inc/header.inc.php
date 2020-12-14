<body>
  <header>
    <?php

    if ($NAV->isLog()) :
      $uRole =  $NAV->isCollab() ? " | {$_SESSION['user']->role}"  : "";
      $test_link  = $NAV->isAdmin() ? "| <a href='./_test' class='" . STYLE::BAR_LINK . " text-white'>TEST</a>" : "";
    ?>

      <section class="bg-dark p-1 small border-0">
        <div class="container text-right text-light">
          <a href=""></a>
          <a href=""></a>
          <a href=""></a>
          <?= "<a href='./profile' class='" . STYLE::BAR_LINK . " text-light'>{$_SESSION['user']->username}{$uRole}</a>$test_link| <a href='./_log?action=out' class='" . STYLE::BAR_LINK . " text-danger'>" . ICON::LOGOUT . "</a>" ?>
        </div>
      </section>
    <?php
    endif;
    if ($NAV->isCollab()) : ?>
      <nav class="bg-white p-0 m-0">
        <div class="mx-auto small p-2 m-0 border-0 text-center">
          <a class="<?= STYLE::ADMIN_MENU ?>" href="./admin">DASHBOARD</a>
          <a class="<?= STYLE::ADMIN_MENU ?>" href="./admin?ad=info" <?= $NAV->hidden(!$NAV->isLeader()) ?>>SHOP INFO</a>
          <a class="<?= STYLE::ADMIN_MENU ?>" href="./admin?ad=user">USER</a>
          <a class="<?= STYLE::ADMIN_MENU ?>" href="./admin?ad=order">ORDER</a>
          <a class="<?= STYLE::ADMIN_MENU ?>" href="./admin?ad=product">PRODUCT</a>
          <a class="<?= STYLE::ADMIN_MENU ?>" href='./admin?ad=category' <?= $NAV->hidden(!$NAV->isLeader()) ?>>CATEGORY</a>
          <a class='<?= STYLE::ADMIN_MENU ?>' href='./admin?ad=mail' <?= $NAV->hidden(false) ?>>MESSAGERIE</a>
        </div>
      </nav>
    <?php endif ?>
    <nav class="navbar navbar-expand-lg bg-gold shadow">
      <section class="container mx-auto">
        <a class="navbar-brand" href="./">
          <img src="<?= $SITE::LOGO ?>" alt="<?= SITE::TITLE ?>" width="75">
        </a>
        <button class="navbar-toggler navbar-dark text-white" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav mx-auto">
            <a class="nav-item nav-link text-white" href="./category"><?= CATEGORY::ALL ?></a>
            <?php foreach ($CATEGORY->getCategoryList(CATEGORY::HOME) as $cat) : ?>
              <a class='nav-item nav-link text-white text-uppercas' href="./category?cat=<?= $cat->name ?>"><?= strtoupper($cat->name)  ?></a>
            <?php endforeach; ?>
          </div>
          <form class="p-0 form-inline my-lg-0 row mx-auto border-bottom" action="./category" method="GET">
            <input class="ndrtInput bg-gold mr-0 col-10 text-white border-0" type="search" placeholder="Rechercher" aria-label="Search" name="q">
            <button class="btn ml-0 col-2 bg-transparent text-light rounded-0" type="submit"><?= ICON::SEARCH ?></button>
          </form>
          <div class="row">
            <div class="col-12 text-center mx-auto">
              <a class="<?= STYLE::NAV_MENU_BTN ?>" <?= $NAV->hidden(!$NAV->isLog()) ?> onclick="goToProfile()"><?= ICON::USER ?> </a>
              <a class="<?= STYLE::NAV_MENU_BTN ?>" <?= $NAV->hidden($NAV->isLog()) ?> onclick="loginModal()"><?= ICON::LOGIN ?></a>
              <a class="<?= STYLE::NAV_MENU_BTN ?>" onclick="goToCart()"><?= ICON::CART ?></a>
            </div>
          </div>
        </div>
      </section>
    </nav>


  </header>