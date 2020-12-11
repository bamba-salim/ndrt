<?php

class CATEGORY extends DB implements CATEGORY_CONST
{
  public $table = self::TABLE['category'] . " as c";

  private const CAT_COL = "c.id, c.name, c.detail, c.img, c.is_active as active";
  private const TYPE_COL = "ct.name AS type, ct.id as idType";
  private const JOIN_TYPE = "JOIN category_type AS ct ON c.type = ct.id";
  private const CONDITIONS = "where c.id = :test or c.name = :test";

  // fetch category list
  public function getCategoryList($object = [])
  {
    extract($object);

    // init random
    $r = !empty($rand) ? self::RAND : "";

    // init type conditions
    $c = !empty($type) ? "where type = $type" : "";

    // init limit conditions
    $l = !empty($limit) ? " limit $limit" : "";

    // init execption condition
    $e = !empty($except) ? (empty($c) ? "where c.id not in ($except)" : " and c.id not in ($except)") : "";

    $req = ['conditions' => $c . $e . $r . $l, 'join' => [self::JOIN_TYPE], 'colonnes' => [self::CAT_COL, self::TYPE_COL]];


    $newReq = new stdClass();
    $newReq->conditions = "$c $e $r $l";
    $newReq->join = [self::JOIN_TYPE];
    $newReq->colonnes = [self::CAT_COL, self::TYPE_COL];


    return $this->select($req);
  }

  // get category
  public function getCategory($cat)
  {
    $test = !empty($cat->test) ? $cat->test : "";
    $req = ['conditions' => self::CONDITIONS, 'data' => [':test' => $test]];

    $newReq = new stdClass();
    $newReq->conditions = self::CONDITIONS;
    $newReq->data = [':test' => $test];

    $category = $this->select($req);
    return !empty($category) ? $category[0] : null;
  }

  // fetch Type Name
  public function getType($type)
  {
    $req = [
      'table' => self::TABLE['categoryType'],
      'conditions' => "where id = :id",
      "data" => [':id' => $type]
    ];

    $newReq = new stdClass();
    $newReq->table = self::TABLE['categoryType'];
    $newReq->conditions = "where id = :id";
    $newReq->data = [':id' => $type];


    $name = $this->select($req);
    return !empty($name) ? $name[0]->name : null;
  }

  // à tcheker
  public function getCatColor($type)
  {
    $value = array();
    switch ($type):
      case 1:
        $value['bg'] = 'dark';
        $value['txt'] = 'gold';
        break;
      case 2:
        $value['bg'] = 'success ';
        $value['txt'] = 'white';
        break;
      case 3:
        $value['bg'] = 'warning';
        $value['txt'] = 'dark';
        break;
    endswitch;
    return $value;
  }

  // show if empty
  public function getFromUrl()
  {
    return isset($_GET['cat']) ? "Les articles de \"{$_GET['cat']}\" n'existent pas." : "L'id' \"{$_GET['id']}\" correspond à un trou noir.";
  }

  //todo à refaire
  public function showCategory($type)
  {
    extract($type);
    echo "<h2 class='text-center p-2 bg-{$bg} text-{$txt} text-uppercase h5'>{$name}</h2>";
    $type['type'] = $id;
    $categoryList = $this->getCategoryList($type);

    foreach ($categoryList as $value) :
      $inactiveClass = $value->active == null || $value->active == 1 ? "" : "bg-secondary text-white";
      echo "<div class='row mx-0 pt-3 $inactiveClass'> 
        <div class='col-6 col-md-6 h6 text-capitalize'>{$value->name} </div>
        <div class='col-2 mr-0 h6 mx-auto text-center'>
          <a href='./category?cat={$value->name}' target='_blank'>
            <span class='" . STYLE::ADMIN_BUTTON . " btn-success'>" . ICON::EYE . "</span>
          </a>
        </div>
        <div class='col-2 mr-0 h6 mx-auto text-center'>
          <a href='./admin?ad={$_GET['ad']}&action=set&id={$value->id}'>
            <span class='" . STYLE::ADMIN_BUTTON . " btn-warning'>" . ICON::EDIT . "</span>
          </a>
        </div>
        ";
      if ($value->active == 1 || $value->active == null) {
        echo "  
        <div class='col-2 h6 mx-auto mr-0 text-center'>        
        <a href='./admin?ad={$_GET['ad']}&action=del&id={$value->id}'>
        <span class='" . STYLE::ADMIN_BUTTON . " btn-danger'>" . ICON::TRASH . "</span>
        </a>
      </div>";
      } else {
        echo "  
        <div class='col-2 h6 mx-auto mr-0 text-center'>        
        <a href='./_set?ad={$_GET['ad']}&action=active&id={$value->id}'>
        <span class='" . STYLE::ADMIN_BUTTON . " btn-info'>" . ICON::POWER . "</span>
        </a>
      </div>";
      }

      echo "</div>
      <hr class='col-12 p-0 m-0'> ";
    endforeach;
  }


  // todo refaire la requete 
  public function createCategory($cat)
  {
    extract($category);
    $this->query2(
      "INSERT INTO category ( name, type, img, detail) VALUES (:categoryName, :categoryType, :categoryImage, :categoryDetail)",
      array(
        ':categoryName' => $name,
        ':categoryType' => $type,
        ':categoryImage' => $image,
        ':categoryDetail' => $detail
      )
    );



    $this->create($category);
  }

  // todo refaire la requete 

  public function updateCategory($category)
  {
    extract($category);
    $this->query2(
      "UPDATE $this->table SET name = :categoryName, detail = :categoryDetail, img = :categoryImage WHERE id = :categoryId",
      array(
        ':categoryId' => $id,
        ':categoryName' => $name,
        ':categoryDetail' => $detail,
        ':categoryImage' => $image
      )
    );
  }

  // todo: à refaire
  public function deleteCategory($id)
  {
    $req = new stdClass();
    $req->sql = "where c.id = :id";
    $req->data = ["id" => $id];
    $this->delete($req);
  }

  // todo refaire la requete 


  public function activeCategory($category)
  {
    extract($category);
    var_dump($id);
    $this->update();
  }
}
