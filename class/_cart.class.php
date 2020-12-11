<?php
class CART extends DB
{
  public function __construct($DB)
  {
    if (!isset($_SESSION)) {
      session_start();
    }
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }
    $this->DB = $DB;

    if (isset($_POST['quantity']));
  }

  public function add($produit)
  {
    extract($produit);

    $product = [];
    $product['id'] = $object->id;
    $product['ref'] = $object->ref;
    $product['name'] = $object->name;
    $product['img'] = $object->img;
    $product['price'] = $object->price;
    intval($qty);
    if (isset($_SESSION['cart'][$ref]['qty'])) :
      $_SESSION['cart'][$ref]['qty'] += $qty;
      $product['qty'] = $_SESSION['cart'][$ref]['qty'];
    else :
      $product['qty'] = $qty;
    endif;
    $_SESSION['cart'][$ref] = $product;
  }

  public function takeOff($ref)
  {
    unset($_SESSION['cart'][$ref]);
  }

  public function upd($ref, $qty)
  {
    $_SESSION['cart'][$ref]['qty'] = $qty;
  }

  public function total()
  {
    $total = 0;
    foreach ($_SESSION['cart'] as $value) {
      $total += $value['price'] * $value['qty'];
    }
    return $total;
  }

  public function newTotal()
  {
    $nav = new NAV();
    $total = new stdClass();
    $product = new PRODUCT();
    if ($nav->isCollab()) {
      $total->remise = $this->total() / 100 * USER::REMISE;
      $total->price = $this->total() - ($this->total() / 100 * USER::REMISE);
    } else {
      $total->remise = 0;
      $total->price = $this->total();
    }
    return $total;
  }

  public function totalRemise()
  {
    $nav = new NAV();
    if ($nav->isCollab()) return $this->total() - ($this->total() / 100 * USER::REMISE);
    else return 0;
  }

  public function countQTY()
  {
    $total = 0;
    foreach ($_SESSION['cart'] as $value) {
      $total += $value['qty'];
    }
    return $total;
  }

  public function cartQty()
  {
    $value = new stdClass();
    switch ($this->countQTY()):
      case 0;
        $text = "Pas d'article";
        break;
      case 1:
        $text = "{$this->countQTY()} article";
        break;
      default:
        $text = "{$this->countQTY()} articles";
        break;
    endswitch;
    $value->qty = $this->countQTY();
    $value->title = $text;
    return $value;
  }
}
