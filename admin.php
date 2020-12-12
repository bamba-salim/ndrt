<?php
require './config/config.php';
$NAV->redirect($NAV->isCollab());

$ptil = isset($_GET['ad']) ? $ADMIN->getAdminTitle($_GET['ad']) : "Tableau de bord";
include_once './inc/head.inc.php';
?>

<body class="p-0 m-0">
  <?php include_once './inc/header.inc.php'; ?>
  <main class="p-0 m-0">
    <div class="bg-dark text-white p-2 text-center">


      <h1 class="bg-dark text-white w-100 text-uppercase h3 mb-0">
        <span <?= $NAV->hidden(!isset($_GET['ad'])) ?>>
          <?= $ADMIN->getAdminTitle($_GET['ad']) ?>
          <a <?= $NAV->hidden(!$ADMIN->addButton($_GET['ad'])) ?> onclick="addButton()" class='py-0 px-1 rounded-0 text-gold pointer'><?= ICON::PLUS ?></a>
          <p <?= $NAV->hidden($_GET['ad'] != "mail") ?> class='p-0 m-0 h6'><?= $MAIL->unreadList() ?> </p>
        </span>
        <span <?= $NAV->hidden(isset($_GET['ad'])) ?>>
          Tableau de bord
        </span>
      </h1>


    </div>
    <?php isset($_GET['ad']) ? $ADMIN->getAdminPage($_GET['ad']) : include './src/admin/_home.php' ?>
  </main>

  <?php
  $script_link = !empty($_GET['ad']) ? $_GET['ad'] : "admin";
  $script = "./js/admin/js-{$script_link}.js?vr=1" ?>
  <?php include_once './inc/footer.inc.php'; ?>