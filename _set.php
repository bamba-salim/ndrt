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
          case 'archive': // 1
            var_dump("archive"); 
            $mail = new stdClass();
            $mail->archive = true;
            $mail->set = 1;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
          case 'unarchive': // 2
            $mail = new stdClass();
            $mail->unarchive = true;
            $mail->set = 0;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
          case 'read': // 3
            $mail = new stdClass();
            $mail->read = true;
            $mail->set = 1;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
          case 'unread': // 4
            $mail = new stdClass();
            $mail->unread = true;
            $mail->set = 0;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
          case 'save': // 5
            $mail = new stdClass();
            $mail->save = true;
            $mail->set = 1;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
          case 'unsave': // 6
            $mail = new stdClass();
            $mail->unsave = true;
            $mail->set = 0;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
          case 'active':
            $mail = new stdClass();
            $mail->active = true;
            $mail->set = 1;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
          case 'inactive':
            $mail = new stdClass();
            $mail->inactive = true;
            $mail->set = 0;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
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
