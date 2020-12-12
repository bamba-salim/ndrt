<?php

class ADMIN extends DB
{

  public const ADD_ITEM_PAGE = ['category','user','order','product','mail'];

  public function getAdminPage($reference)
  {
    if (isset($reference)) {
      switch ($reference) {
        case 'info':
          include_once('./src/admin/_info.php');
          break;
        case 'order':
          include_once('./src/admin/_order.php');
          break;
        case 'user':
          include_once('./src/admin/_user.php');
          break;
        case 'category':
          include_once('./src/admin/_category.php');
          break;
        case 'product':
          include_once('./src/admin/_product.php');
          break;
        case 'mail':
          include_once('./src/admin/_mail.php');
          break;
        default:
          include_once('./src/admin/_home.php');
          break;
      }
    }
  }

  function getAdminTitle($reference)
  {
    if (isset($reference)) :
      switch ($reference):
        case 'info':
          return 'Info du site';
          break;
        case 'order':
          return 'Suivi des commandes';
          break;
        case 'user':
          return 'Utilisateurs';
          break;
        case 'category':
          return 'Gestions des catégories';
          break;
        case 'product':
          return 'Gestion des produits';
          break;
        case 'mail':
          return 'Messagerie';
          break;
        default:
          return 'Tableau de bord';
          break;
      endswitch;
    endif;
  }

  public function getCrudPage($page, $action)
  {

    switch ($action):
      case 'add':
        include('./src/admin/' . $page . '/add.php');
        break;
      case 'set':
        include('./src/admin/' . $page . '/set.php');
        break;
      case 'del':
        include('./src/admin/' . $page . '/del.php');
        break;
      default:
        include('./src/admin/' . $page . '/get.php');
        break;
    endswitch;
  }

  public function addButton($page)
  {
    return in_array($page,self::ADD_ITEM_PAGE);
  }
}
