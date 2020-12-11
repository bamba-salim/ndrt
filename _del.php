<?php
require './config/config.php';

var_dump($_GET);
var_dump($_POST);
extract($_POST);
if (isset($_GET['ad'])) :

  switch ($_GET['ad']):

    case 'prod': //Supprimer produit -> todo
      echo "Je vais supprimer le produit numéro {$_GET['id']}";
      break;

    case 'category': //Supprimer catégory -> done
      $CATEGORY->deleteCategory($categoryId);
      header('location: admin?ad=category');
      break;

    case 'mail': //Supprimer message -> done
// a refaire 
      if(!empty($mail['mail'])) 
      $mail['ref'] = isset($_GET['ref']) && $_GET['ref'] != null ? $_GET['ref'] : "";
      $mail['id'] = isset($_GET['id']) && $_GET['id'] != null ? $_GET['id'] : "";
      $MAIL->deleteMail($mail);
      $NAV->goBack();
      break;

    case 'user': //Supprimer user -> todo
      echo "je vais supprimer l'user'numéro {$_GET['ref']}";
      break;

    case 'adress': //Supprimer adress -> ok
      $ADRESSE->setInactive($_GET['id']);
      $NAV->goBack();
      break;

  endswitch;

endif;
