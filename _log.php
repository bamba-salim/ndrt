<?php
require './config/config.php';
extract($_POST);
if (isset($_GET['action'])) :
  switch ($_GET['action']):
    case 'out': // Déconnection -> done
      unset($_SESSION['user']);
      $NAV->redirect($NAV->isLog());
      break;
    case 'in': // Connection -> done
      $u = $USER->getUser($login);
      if ($u != null) {
        $_SESSION['user'] = $LOGIN->logUser($u->info);
        $NAV->goBack();
      } else {
        $NAV->goBack();
      }



      break;
    case 'up':
      $u = $USER->getUser($_SESSION['user']->id);
      $_SESSION['user'] = $LOGIN->logUser($u->info);
      $NAV->goBack();
      // !empty($_SESSION['cart']) ? header('location: ./cart') : header('location: ./profile');
      break;
  endswitch;
endif;
