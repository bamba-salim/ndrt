<?php
$FORM = new FORM();
$USER = new USER();

if (!isset($_GET['ref'])) :
  $s = isset($_POST['s']) ? $_POST['s'] : '';
  $svalue = isset($_POST['s']) ? $_POST['s'] : '';
  $users = $USER->getUserList();
  $activeSearch = 'off';
  if (!$FORM->newInput($s, REGEX::TEXT)) {
    $users = [];
    $activeSearch = 'err';
  } else {
    $activeSearch = 'on';
    $s = htmlspecialchars(trim($s));
    $s = preg_split(REGEX::SPLIT, $s);
    $sql = USER::SELECT;
    $i = 0;
    foreach ($s as $value) {
      if ($i == 0) {
        $sql .= ' WHERE ';
      } else {
        $sql .= ' OR ';
      }
      $sql .= "concat(u.nom, u.prenom, u.mail, u.ref, u.username) LIKE '%$value%'";
      $i++;
    }
    $sql .= ' AND role IN (' . USER::CLIENT_ID . ') ORDER BY created_at desc';
    $users = DB()->fetch($sql);
    $count = count($users);
  }
  $uscount = count($users);
?>
  <section class="my-3 container">
    <div class="bg-dark text-gold row p-0 m-0 h5">
      <div class="col-2 p-2">
        <p class="m-0 text-center"><?= $uscount ?></p>
      </div>
      <div class="col-5 col-md-6 p-2">
        <p class="m-0">USER INFO</p>
      </div>
      <div class="col-5 col-md-4 p-1">
        <form class="form-inline mx-auto p-0 row border-bottom" method="POST">
          <input class="ndrtInput bg-transparent mr-0 col-10 text-white border-0" type="search" placeholder="Recherche..." aria-label="Search" name="s" />
          <button class="btn ml-0 col-2 bg-transparent text-light rounded-0 p-0" type="submit"><?= ICON::SEARCH ?></button>
        </form>
      </div>
    </div>
    <?php
    switch ($activeSearch) {
      case 'off':
        break;
      case 'err':
        echo '<div class="alert alert-danger p-0 m-0 border-0 rounded-0">';
        echo '<p class="w-100 small p-2">Veuillez entrez une recherche valide</p>';
        echo '</div>';
        break;
      case 'on':
        if ($value === '') {
        } else if ($count == 0) {
          NOT_FOUND();
        } else {
          echo '<div class="alert alert-success p-0 m-0 border-0 rounded-0"><p class="w-100 small p-2">';
          echo $count . ' résultas pour "' . trim($svalue) . '"';
          echo '</p></div>';
        }
        break;
    }
    foreach ($users as $user) { ?>
      <div class="row row-cols-3 m-0 p-1 ndrt-hover" onclick="window.location.href='./admin?ad=users&ref=<?= $user->ref ?>'">
        <div class="col-3 col-md-2 text-center p-1 align-middle">
          <?= $user->ref ?>
        </div>
        <div class="col-9 col-md-7 row">
          <div class="col-md-6 col-12">
            <div class="p-1"><?="$user->username"?></div>
            <div class="p-1"><?= $user->mail ?></div>
          </div>
        </div>
        <div class="col-md-3 md-screen">
          <div class="p-1"><?= $USER->DATE($user->created_at) ?></div>
          <div class="p-1">Order:</div>
        </div>
      </div>
      <hr class="col-12 my-2">
    <?php } ?>
  </section>
  <?php
else :

  $u = $USER->getUser($_GET['ref']);
  if (empty($u)) {
    NOT_FOUND();
  } else {
  ?>
    <main>
      <section class="<?= STYLE::ADMIN_TITLE_BG ?>">
        <h2 class="<?= STYLE::ADMIN_TITLE ?>"><?= ucfirst($u->nom) . ' "' . ucfirst($u->username) . '" ' . ucfirst($u->prenom) ?></h2>
      </section>
      <section class="container">
        <div class="row row-cols-1 row-cols-lg-2">
          <div class="col my-2">
            <div class="h-100 card rounded-0">
              <div class="card-header p-0 border-0 bg-transparent row">
                <div class="col-6">
                  <p class="p-3 m-0"><?= $_SESSION['user']->ref ?></p>
                </div>
                <div class="col-6">
                  <p class="text-right p-3 m-0"><?= $u->d ?></p>
                </div>
              </div>
              <div class="card-body p-5">
                <h5 class="card-title h1 font-weight-bold text-gold"></h5>
                <p class="card-text h5"><?= ucfirst($u->mail); ?></p>
              </div>
              <div class="card-footer border-0 p-0 bg-transparent">
                <p class="text-center p-3 m-0">Modifié mes infos</p>
              </div>
            </div>
          </div>
          <div class="col my-2">
            <div class="h-100 card rounded-0">
              <div class="card-header p-0 border-0 bg-transparent">
                <p class="text-right p-3 m-0 h5">Adresse de facturation</p>
              </div>
              <div class="card-body p-5">
                <p class="card-text h5"><?= "adresse" ?></p>
                <p class="card-text h5"><?= "complement" ?></p>
                <p class="card-text h5"><?= "zip - ville" ?></p>
                <p class="card-text h5"><?= "pays" ?></p>
              </div>
              <div class="card-footer border-0 p-0 bg-transparent">
                <p class="text-center p-3 m-0">Modifié mon adresse</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="container my-2">
        <div class="row row-cols-1 m-0 border p-0">
          <div class="col-12 mx-auto p-0">
            <div class="card rounded-0 bg-dark p-3">
              <h2 class="text-gold text-center text-uppercase">Mes Commandes</h2>
            </div>
          </div>

        </div>
      </section>
    </main>
<?php
  }
endif;
