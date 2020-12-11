<?php
$ADMIN = new ADMIN();

if (isset($_GET['action'])) :
  $ADMIN->getCrudPage($_GET['ad'], $_GET['action']);
else :
  include("./src/admin/{$_GET['ad']}/get.php");
endif;
