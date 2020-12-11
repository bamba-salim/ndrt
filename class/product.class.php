<?php

class PRODUCT extends DB
{
  public $table = self::TABLE['product'] . " as p";

  private const PRODUCT_COL = "p.id, p.name, p.price, p.img, p.color, p.ref, p.description, p.composition, p.qty";
  private const PRODUCT_LIST_COL = "p.id, p.ref, p.name, p.price, p.img,  p.qty";

  private const CAT_COL = "cat.id as idCat, cat.name as cat";
  private const ALT_COL = "alt.id as idAlt, alt.name as alt";
  private const COL_COL = "col.id as idCol , col.name as col";

  private const JOIN_CAT = "JOIN category AS cat ON cat.id = p.cat";
  private const JOIN_ALT = "JOIN category AS alt ON alt.id = p.alt";
  private const JOIN_COL = "JOIN category AS col ON col.id = p.col";

  private const ID_CATEGORY_CONDITIONS = "p.cat = :test || p.alt = :test || p.col = :test";
  private const NAME_CATEGORY_CONDITIONS = "cat.name = :test || alt.name = :test || col.name = :test";

  private const CATEGORY_CONDITIONS =  "where (" . self::ID_CATEGORY_CONDITIONS .  ' || ' . self::NAME_CATEGORY_CONDITIONS . ") ";

  public const SELL = "UPDATE product SET qty = :qty WHERE ref = :ref";


  // à changer en classe
  public function getProduct2($product = [])
  {
    extract($product);

    $r = !empty($rand) ? self::RAND : "";
    $c = !empty($test) ? "where p.name = :test or p.id = :test or p.ref = :test" : "";

    $req = [
      "conditions" => $c . $r,
      "join" => [self::JOIN_CAT, self::JOIN_ALT, self::JOIN_COL],
      "colonnes" => [self::PRODUCT_COL, self::CAT_COL, self::ALT_COL, self::COL_COL],
      "data" => [":test" => $test]
    ];

    $newReq = new stdClass();
    $newReq->conditions = "$c $r";
    $newReq->join = [self::JOIN_CAT, self::JOIN_ALT, self::JOIN_COL];
    $newReq->colonnes = [self::PRODUCT_COL, self::CAT_COL, self::ALT_COL, self::COL_COL];
    $newReq->data = [":test" => $test];

    return $this->select($req)[0];
  }

  // à utiliser
  public function getProduct($product)
  {

    $condition = "";
    $r = "";

    if (!empty($product->id)) {
      $test = $product->id;
      $condition = "where p.id = :test";
    } elseif (!empty($product->ref)) {
      $test = $product->ref;
      $condition = "where p.ref = :test";
    } elseif (!empty($product->name)) {
      $test = $product->name;
      $condition = "where p.name = :test";
    }

    if (!empty($product->rand)) $r = self::RAND;

    $req = [
      "conditions" => "$condition $r",
      "join" => [self::JOIN_CAT, self::JOIN_ALT, self::JOIN_COL],
      "colonnes" => [self::PRODUCT_COL, self::CAT_COL, self::ALT_COL, self::COL_COL],
      "data" => [":test" => $test]
    ];

    $newReq = new stdClass();
    $newReq->conditions = "$condition $r";
    $newReq->join = [self::JOIN_CAT, self::JOIN_ALT, self::JOIN_COL];
    $newReq->colonnes = [self::PRODUCT_COL, self::CAT_COL, self::ALT_COL, self::COL_COL];
    $newReq->data = [":test" => $test];

    return $this->select($req)[0];
  }

  public function getProductList($object = null)
  {
    $test = '';
    $n = !empty($object->new) ? "order by p.created_at DESC" : "";
    $e = !empty($object->except) ? "and p.id not in ($object->except)" : "";
    $l = !empty($object->limit) ? "limit $object->limit" : "";
    $r = !empty($object->rand) ? self::RAND : "";
    if (!empty($object->test)) $test = $object->test;
    if (!empty($object->name)) $test = $object->name;
    $c = !empty($test) ? self::CATEGORY_CONDITIONS : '';

    $req = [
      "conditions" => "$c $e $r $n $l",
      "join" => [self::JOIN_ALT, self::JOIN_CAT, self::JOIN_COL],
      "colonnes" => [self::PRODUCT_LIST_COL, self::COL_COL, self::ALT_COL, self::CAT_COL],
      "data" => [":test" => $test]
    ];

    $newReq = new stdClass();
    $newReq->conditions = "$c $e $r $n $l";
    $newReq->join = [self::JOIN_ALT, self::JOIN_CAT, self::JOIN_COL];
    $newReq->colonnes = [self::PRODUCT_LIST_COL, self::COL_COL, self::ALT_COL, self::CAT_COL];
    $newReq->conditions = [":test" => $test];
    $list = $this->select($req);
    return $list;
  }



  public function updateProduct()
  {
    # todo
  }



  public function gestionRole()
  {
    # todo
  }

  public function gestionBlock()
  {
    # todo
  }

  public function gestionActived()
  {
    # todo
  }

  public function deleteProduct()
  {
    # todo
  }

  public function listProduct($type)
  {
?>
    <nav class='container'>
      <ol class='my-3 <?= "bg-{$type->bg}" . SITE::NO_BDR_AND_RND ?>'>
        <li class='<?= "text-{$type->txt}" ?> text-center py-3 h4'><?= strtoupper($type->title) ?></li>
      </ol>
    </nav>
    <section class="container mb-3">
      <div class="row row-cols-2 row-cols-lg-4 my-2">
        <?php foreach ($this->getProductList($type) as $value) : ?>

          <div class="col mb-1">
            <div class="card h-100 border-0 my-2 ndrt-hover rounded-0 p-0" onClick="window.location='./product?ref=<?= $value->ref ?>';">
              <figure class="m-0 p-0">
                <div class="gallery-selected m-0">
                  <img src="<?= $value->img ?>" alt="<?= $value->name ?>" class="" />
                </div>
              </figure>
              <div class='p-1 m-0'>
                <p class='p-0 m-0 h4'><?= ucfirst($value->name) ?></p>
                <p class='small p-0 m-0 h6'><em><?= ucfirst($value->col) ?></em></p>
                <p class='text-right text-gold font-weight-bold p-0 my-2'><?= $this->PRICE($value->price)->currency ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
<?php
  }
}
