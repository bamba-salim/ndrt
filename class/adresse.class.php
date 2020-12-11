<?php

class ADRESSE extends DB
{

  public $table = self::TABLE['adresse'] . " as a";
  public const FRA_ID = 1;
  public const BEL_ID = 2;
  public const SWI_ID = 4;
  public const LUX_ID = 3;
  public const FRA_NAME = "France";
  public const BEL_NAME = "Belgique";
  public const SWI_NAME = "Suisse";
  public const LUX_NAME = "Luxembourg";
  public const TYPE_L_ID = 2;
  public const TYPE_F_ID = 1;
  public const TYPE_L_NAME = "Livraison";
  public const TYPE_F_NAME = "Facturation";


  public const ADR_COL = "a.*, a.pays as idPays";

  public const JOIN_COUNTRY = 'left join country as c on c.id = a.pays';
  public const COL_COUNTRY = "c.name as pays";



  public function getAdresseList($object)
  {
    var_dump($object);
    $conditions = "";
    $test = "";
    $actived = "";


    if (!empty($object->user)) {
      $conditions = "where a.user = :test";
      $test = $object->user;
    }

    if (!empty($object->actived)) $actived = empty($conditions) ? "where a.is_active = 1" : "and a.is_active = 1";
    

    $req = [
      'conditions' => "$conditions $actived order by created_at desc",
      'join' => [self::JOIN_COUNTRY],
      'colonnes' => [self::ADR_COL, self::COL_COUNTRY],
      'data' => ['test' => $test]
    ];

    $newReq = new stdClass();
    $newReq->conditions = "$conditions $actived order by created_at desc";
    $newReq->join = [self::JOIN_COUNTRY];
    $newReq->colonnes = [self::ADR_COL, self::COL_COUNTRY];
    $newReq->data = ['test' => $test];


    $list =  $this->select($req);
    var_dump($list);
    return !empty($list) ? $list : null;
  }


  public function setInactive($id)
  {
    $adress = new stdClass();
    $adress->values = ['a.is_active = 0'];
    $adress->conditions = "where id = :id";
    $adress->data = [':id' => $id];
    $this->update($adress);
  }


  public function getAdresse($adress)
  {
    $newReq = new stdClass();
    $newReq->conditions = "where a.id = $adress";

    $req = ['conditions' => "where a.id = $adress"];
    $adresse = $this->select($req);
    return !empty($adresse) ? $adresse[0] : null;
  }


  function getCountry($inputType)
  {
    if (isset($inputType)) :
      switch ($inputType) {
        case self::LUX_ID:
          return self::LUX_NAME;
          break;
        case self::FRA_ID:
          return self::FRA_NAME;
          break;
        case self::BEL_ID:
          return self::BEL_NAME;
          break;
        case self::SWI_ID:
          return self::SWI_NAME;
          break;
        default:
          return null;
          break;
      }
    endif;
  }

  // get countries
  public function fetchCountry($object = [])
  {
    extract($object);
    $req['table'] = self::TABLE['country'];
    if (!empty($pays)) $req['conditions'] = "where id not in ($pays)";
    
    $newReq = new stdClass();
    $newReq->table = self::TABLE['country'];
    //if (!empty($pays)) $newReq->conditions = "where id not in ($object->pays)";

    return $this->select($req);
  }

  // add new adresse
  public function createAdress($adressAdd)
  {
    extract($adressAdd);
    $adress = new stdClass();
    $adress->colonnes = ["name", "client", "society", "adresse", "complement", "zip", "ville", "region", "pays", "phone"];
    $adress->values = ["name", ":client", ":society", ":adresse", ":complement", ":zip", ":ville", ":region", ":pays", ":phone"];
    $adress->data = [":name" => $name, ":client" => $client, ":society" => $society, ":adresse" => $adresse, ":complement" => $complement, ":zip" => $zip, ":ville" => $ville, ":region" => $region, ":pays" => $pays, ":phone" => $phone];
    $this->create($object);
  }

  // upadat adresse
  public function updateAdress($adressSet)
  {
    extract($adressSet);
    $adress = new stdClass();
    $adress->conditions = "where a.id = :id";
    $adress->values = ["a.name = :name", "a.client = :client", "society = :society", "adresse = :adresse", "complement = :complement", "zip = :zip", "ville = :ville", "region = :region", "pays = :pays", "phone = :phone"];
    $adress->data = [":id" => $id, ":name" => $name, ":client" => $client, ":society" => $society, ":adresse" => $adresse, ":complement" => $complement, ":zip" => $zip, ":ville" => $ville, ":region" => $region, ":pays" => $pays, ":phone" => $phone];
    $this->update($adress);
  }
}
