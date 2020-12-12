<?php
require './config/config.php';
extract($_POST);
$errors = [];

if (isset($_GET['ad'])) {
  switch ($_GET['ad']) {
    case 'category':
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'active':
            $category['id'] = $_GET['id'];
            $CATEGORY->activeCategory($category);
            break;
          default:
            $category['id'] = $categoryId;
            $category['name'] = $categoryName;
            $category['detail'] = $categoryDetail;
            $category['image'] = $categoryImage;
            $CATEGORY->updateCategory($category);
            break;
        }
      }
      header('location: ./admin?ad=category');
      break;

    case 'mail':
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'archive':
            var_dump("{$_GET['action']} {$_GET['id']}");

            $object['ref'] = $_GET['ref'];
            $object['set'] = $MAIL::TRUE;
            //$MAIL->gestionArchiveStatut($object);
            break;
          case 'unarchive':
            var_dump("{$_GET['action']} {$_GET['id']}");

            $object['ref'] = $_GET['ref'];
            $object['set'] = $MAIL::FALSE;
            //$MAIL->gestionArchiveStatut($object);
            break;
          case 'read':
            var_dump("{$_GET['action']} {$_GET['id']}");

            $object['ref'] = $_GET['ref'];
            $object['set'] = $MAIL::TRUE;
            //$MAIL->gestionReadStatut($object);
            break;
          case 'unread':
           // var_dump("{$_GET['action']} {$_GET['id']}");
            $mail = new stdClass();
            $mail->unread = true;
            $mail->set = 0;
            $mail->id = $_GET['id'];


            $MAIL->gestionStatut($mail);
            break;
          case 'save':
            var_dump("{$_GET['action']} {$_GET['id']}");
            break;
          case 'unsave':
            var_dump("{$_GET['action']} {$_GET['id']}");
            break;
          case 'active':
            var_dump("{$_GET['action']} {$_GET['id']}");
            break;
          case 'inactive':
            var_dump("{$_GET['action']} {$_GET['id']}");
            break;
          default:
            # code...
            break;
        }
      }
      break;
    case 'adress':
      $ADRESSE->updateAdress($_POST);
      header("location: ./profile");
      break;
    case 'order':
      var_dump($_GET['id']);

      $order = new stdClass();
      $order->id = $_GET['id'];
      $order->cancel = true;
      $ORDER->gestionStatus($order);
      $NAV->goBack();
      break;
    default:
      // header('location: ./');
      break;
  }
}
