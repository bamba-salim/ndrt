<?php
require './config/config.php';
$NAV->redirect(!$NAV->isLog());
if (isset($_GET['sign'])) {
  switch ($_GET['sign']):
    case 'in':
      $log = array(STYLE::LOGIN_ACTIVE, STYLE::LOGIN_INACTIVE, LOG::IN_NAME, LOG::IN_MSG);
      break;
    case 'up';
      $log = array(STYLE::LOGIN_INACTIVE, STYLE::LOGIN_ACTIVE, LOG::UP_NAME, LOG::UP_MSG);
      break;
    default:
      header('location: ./login?sign=in');
      break;
  endswitch;
}
$ptil = strtoupper($log[2]);
include_once('./inc/head.inc.php');
include_once('./inc/header.inc.php');
?>
<main class="container p-0">
  <section class="row-cols-1 my-3">
    <div class="bg-dark text-white container py-2">
      <h1 class="text-center text-white w-100 text-uppercase h3 my-2">
        Connectez-vous
      </h1>
    </div>
    <nav class="row text-center m-0 container p-0">
      <div class="<?= $log[0] ?> col p-0">
        <a class="<?= STYLE::LOGIN_LINK ?> <?= $log[0] ?>" href="./login?sign=in"> <?= ucfirst(LOG::IN_NAME) ?></a>
      </div>
      <div class="<?= $log[1] ?> col p-0">
        <a class="<?= STYLE::LOGIN_LINK ?> <?= $log[1] ?>" href="./login?sign=up"><?= ucfirst(LOG::UP_NAME)  ?></a>
      </div>
    </nav>
    <div class="bg-dark container">
      <h2 class="text-white text-center text-white w-50 text-uppercase h3 mx-auto py-5"><?= $log[3] ?></h2>
    </div>
  </section>
  <section class="row-cols-1 my-3">
    <?php debug() ?>
  </section>
  <div class="row-cols-1">
    <?php
    if (isset($_GET['sign'])) :
      switch ($_GET['sign']):
        case 'in':
          LOGIN_SIGNIN();
          break;
        case 'up':
          LOGIN_SIGNUP();
          break;
        default:
          LOGIN_SIGNIN();
          break;
      endswitch;
    endif;
    ?>
  </div>
</main>
<?php unDebug() ?>
<?php include_once('./inc/footer.inc.php') ?>