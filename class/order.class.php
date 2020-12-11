<?php

class ORDER extends DB
{

  public $table = self::TABLE['orders'] . " as o";

  // get orders list
  public function getOrderList($object)
  {
    $conditions = "";

    if (!empty($object->order)) {
      $conditions = "where o.ref = :test or o.id = :test";
      $test = $object->order;
    }

    if (!empty($object->user)) {
      $conditions = "where o.user = :test";
      $test = $object->user;
    }

    $req = ['conditions' => $conditions . " order by o.created_at desc", 'data' => [":test" => $test], 'colonnes' => ['id']];

    $newReq = new stdClass();
    $newReq->conditions = "$conditions order by o.created_at desc";
    $newReq->colonnes = ['id'];
    $newReq->data = [":test" => $test];

    $list = $this->select($req);

    return !empty($list) ? $list : null;
  }

  // get order
  public function getOrder($order)
  {
    $object = new stdClass();
    $ADRESSE = new ADRESSE();

    $object->info = $this->fetchOrderInfo($order);

    if (!empty($object->info)) {
      $object->status = $this->fetchOrderStatus($object->info);
      $object->livraison = $ADRESSE->getAdresse($object->info->livraison);
      $object->facturation = $ADRESSE->getAdresse($object->info->facturation);
      $object->products = $this->fetchOrderProduct($object->info);
    }

    return !empty($object) ? $object : null;
  }

  // get order info
  public function fetchOrderInfo($order)
  {
    if (!empty($order->ref)) {
      $conditions = "where o.ref = :test";
      $test = $order->ref;
    }

    if (!empty($order->id)) {
      $conditions = "where o.id = :test";
      $test = $order->id;
    }

    $req = ['conditions' => $conditions, 'data' => [':test' => $test]];

    $newReq = new stdClass();
    $newReq->conditions = $conditions;
    $newReq->data = [':test' => $test];

    $o = $this->select($req);
    return !empty($o) ? $o[0] : null;
  }

  // get order status
  public function fetchOrderStatus($order)
  {
    $req = ["table" => self::TABLE['ordersProduct'], "conditions" => "where id = {$order->status}"];

    $newReq = new stdClass();
    $newReq->table = self::TABLE['ordersProduct'];
    $newReq->conditions = "where id = {$order->status}";

    return $this->select($req)[0];
  }

  // get order product
  public function fetchOrderProduct($order)
  {
    $PRODUCT = new PRODUCT();
    $productList = [];
    $req = [
      'table' => self::TABLE['ordersProduct'],
      'conditions' =>  "where orders = $order->id",
      'colonnes' => ["product as id", "price", "qty"]
    ];
    
    $newReq = new stdClass();
    $newReq->table = self::TABLE['ordersProduct'];
    $newReq->colonnes = ["product as id", "price", "qty"];
    $newReq->conditions = "where orders = $order->id";

    // // get product id list
    $list = $this->select($req);

    // // get product list
    foreach ($list as $value) {
      $prod['test'] = $value->id;
      $object = new stdClass();
      $object->product =  $PRODUCT->getProduct2($prod);
      $object->qty = $value->qty;
      $object->price = $value->price;

      array_push($productList, $object);
    }
    return !empty($productList) ? $productList : "";
  }

  // gestion status
  public function gestionStatus($order)
  {
    var_dump($order);
    $order->conditions = "where o.id = :order";
    if (!empty($order->cancel)) $order->values = ["o.status = 0"];
    if (!empty($order->done)) $order->values = ["o.status = 1"];
    if (!empty($order->transit)) $order->values = ["o.status = 2"];
    if (!empty($order->ready)) $order->values = ["o.status = 3"];
    if (!empty($order->valid)) $order->values = ["o.status = 4"];
    //$order->data = [':order' => $order->id];
    var_dump($order);
    //$this->update($order);
  }

  // switch status date
  public function dateStatus($order)
  {
    $status = $order->status->id;

    switch ($status):
      case 1:
        return $order->info->delivered_at;
        break;
      case 0:
        return $order->info->canceled_at;
        break;
      default:
        return $order->info->predict_at;
        break;
    endswitch;
  }

  // order progress bar
  public function progress_bar($order)
  {
    return "<div class='" . self::PROGRESS_BAR . " {$order->style}' role='progressbar'>{$order->name}</div>";
  }

  // get user order totals
  public function getOrdersTotals($user)
  {
    $order = new stdClass();

    $req1 = ["colonnes" => ['sum(o.total) as total'], "conditions" => "where user = $user  and o.status not in (0)"];
    $req2 = ["colonnes" => ['count(o.id) as count'], "conditions" => "where user = $user and o.status not in (0)"];

    $newReq1 = new stdClass();
    $newReq1->colonnes = ['sum(o.total) as total'];
    $newReq1->conditions = "where user = $user  and o.status not in (0)";

    $newReq2 = new stdClass();
    $newReq2->colonnes = ['count(o.id) as count'];
    $newReq2->conditions = "where user = $user  and o.status not in (0)";
   
    $order->total = $this->select($req1)[0]->total;
    $order->count = $this->select($req2)[0]->count;

    $order->total = !empty($order->total) ? $order->total : 0;
    $order->count = !empty($order->count) ? $order->count : 0;

    return !empty($order) ? $order : null;
  }

  // get order ID
  public function getOrderID($ref)
  {
    $req = [
      "conditions" => "where ref = '$ref'",
      "colonnes" => ["id"]
    ];

    $newReq = new stdClass();
    $newReq->conditions = "where ref = '$ref'";
    $newReq->colonnes = ["id"];
    
    return $this->select($req)[0]->id;
  }

  // update product quantity
  public function updateProductQty($prod)
  {
    $PRODUCT = new PRODUCT();

    $newQty = $PRODUCT->getProduct($prod)->qty - $prod->qty;
    $product = new stdClass();
    $product->table = $this->dbTable->product;
    $product->values = ["qty = :qty"];
    $product->conditions = "where id = $prod->id";
    $product->data = [":qty" => $newQty];

    var_dump($product);
    $this->update($product);
  }


  // create order
  public function creatOrder($order)
  {
    $addDetails = new stdClass();
    $addOrder = new stdClass();
    $ref = $this->ref;
    $order_date = $this->date;
    $predict_date = $this->generateDate(3, 'D');
    $user = !empty($order->ref) ? $order->ref : $_SESSION['user']->id;

    $addOrder->colonnes = ["ref", "user", "facturation", "livraison", "qty", "remise", "total", "created_at", "predict_at"];
    $addOrder->values =   [":ref", ":user", ":facturation", ":livraison", ":qty", ":remise", ":total", ":created_at", ":predict_at"];
    $addOrder->data =     [":ref" => $ref, ":user" => $user, ":facturation" => $order->facturation, ":livraison" => $order->livraison, ":qty" => $order->qty, ":remise" => $order->remise, ":total" => $order->total, ":created_at" => $order_date, ":predict_at" => $predict_date];
    $this->create($addOrder);
    $orderID = $this->getOrderID($ref);

    $addDetails->table = self::TABLE['ordersProduct'];
    $addDetails->colonnes = ["orders", "product", "price", "qty"];
    $addDetails->values = [":orders", ":product", ":price", ":qty"];
    foreach ($order->products as $product) {
      extract($product);
      $addDetails->data = [":orders" => $orderID, ":product" => $id, ":price" => $price, ":qty" => $qty];
      $this->create($addDetails);
    }
  }
}
