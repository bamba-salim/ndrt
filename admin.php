<?php
require './config/config.php';
$NAV->redirect($NAV->isCollab());

$ptil = isset($_GET['ad']) ? $ADMIN->getAdminTitle($_GET['ad']) : "Tableau de bord";
include_once('./inc/head.inc.php');
?>

<body class="p-0 m-0">
  <?php include_once('./inc/header.inc.php'); ?>
  <main class="p-0 m-0">
    <div class="bg-dark text-white p-2">
      <h1 class="text-center bg-dark text-white w-100 text-uppercase h3">
        <?php
        if (isset($_GET['ad'])) {
          echo $ADMIN->getAdminTitle($_GET['ad']);
          if ($_GET['ad'] == "mail")  echo "<p class='p-0 m-0 h6'> <span class='small'>" . $MAIL->readMail($MAIL->UNREADED) . "</span></p>";
          if ($ADMIN->addButton($_GET['ad'])) echo "<a href='./admin?ad={$_GET['ad']}&action=add' class='py-0 px-1 rounded-0 text-gold' style='cursor: pointer;'>" .  ICON::PLUS . "</a>";
        } else {
          echo "Tableau de bord";
        }

        ?>
      </h1>
    </div>
    <?php isset($_GET['ad']) ? $ADMIN->getAdminPage($_GET['ad']) : include('./src/admin/_home.php') ?>
  </main>

  <?php
  $script_link = !empty($_GET['ad']) ? $_GET['ad'] : "admin";
  $script = "./js/admin/js-{$script_link}.js?vr=0" ?>
  <?php include_once('./inc/footer.inc.php'); ?>