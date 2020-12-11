<?php
require './config/config.php';
extract($_POST);
if (isset($_GET['action'])):
    switch ($_GET['action']):
    case 'out': // Déconnection -> done
        unset($_SESSION['user']);
        $NAV->redirect($NAV->isLog());
        exit();
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

        endswitch;
    endif;
