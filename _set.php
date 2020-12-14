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

            ///// save | UNSAVE /////
          case 'save':
            $mail = new stdClass();
            $mail->save = true;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
          case 'unsave':
            $mail = new stdClass();
            $mail->unsave = true;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;

            ///// READ | UNREAD /////
          case 'read':
            $mail = new stdClass();
            $mail->read = true;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
          case 'unread':
            $mail = new stdClass();
            $mail->unread = true;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;

            // set archive
          case 'archive':
            $mail = new stdClass();
            $mail->archive = true;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;
            // delete from archive
          case 'unarchive':
            $mail = new stdClass();
            $mail->unarchive = true;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;



            // delete from inative
          case 'active':
            $mail = new stdClass();
            $mail->active = true;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;

            // set inative - trashed
          case 'inactive':
            $mail = new stdClass();
            $mail->inactive = true;
            $mail->id = $_GET['id'];

            $MAIL->gestionStatut($mail);
            break;



            // delte mail
          case 'delete':
            $mail = new stdClass();
            $MAIL->deleteMail($_GET['id']);
            break;

            // delete all mail
          case 'deleteAll':
            $MAIL->deleteAllMail();
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
