<?php
class DB extends GENERAL
{
  private $host = 'localhost';
  private $username = 'root';
  private $password = 'admin12345';
  private $database = 'ndrt';
  public $DB;
  public $table = " dataBase ";

  public function __construct($host = null, $username = null, $password = null, $database = null)
  {
    if ($host != null) {
      $this->host = $host;
      $this->username = $username;
      $this->password = $password;
      $this->database = $database;
    }
    try {
      $this->DB = new PDO(
        "mysql:host=$this->host;dbname=" . $this->database,
        $this->username,
        $this->password,
        array(
          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
          PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        )
      );
    } catch (PDOException $e) {
      die('<h1>Impossible de se connecter à la base de donnée</h1>');
    }

    $this->ref = $this->generateRef();
    $this->date = $this->generateDate();

    extract($_SESSION);
    if (isset($user))  $this->account = $user;

  }



  // delet, create, update
  public function query2($req, $data = array())
  {
    $req = $this->DB->prepare($req);
    var_dump($req);
    $req->execute($data);
  }

  public function query($req)
  {
    $newReq = $this->DB->prepare($req->sql);
    // var_dump($newReq);
    $newReq->execute($req->data);
  }

  //get
  public function select($object = [])
  {
    extract($object);

    $table = empty($table) ? $this->table : $table;
    $conditions = empty($conditions) ? "" : $conditions;
    $col = empty($colonnes) ? "*" : implode(",", $colonnes);
    $joi = empty($join) ? "" : implode(" ", $join);
    $data = empty($data) ? [] : $data;

    $req = $this->DB->prepare("SELECT $col from $table $joi $conditions");
    // var_dump($req);
    // var_dump($data);
    $req->execute($data);
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  // create
  public function create($object)
  {
    //var_dump($object);
    $table = empty($object->table) ? $this->table : $object->table;
    $c = empty($object->colonnes) ? "" : implode(",", $object->colonnes);
    $v = empty($object->values) ? "" : implode(",", $object->values);

    $req = new stdClass();
    $req->sql = "INSERT INTO $table ($c) VALUES ($v)";
    $req->data = empty($object->data) ? [] : $object->data;

    $this->query($req);
  }

  // update
  public function update($object)
  {

    $v = implode(",", $object->values);
    $table = !empty($object->table) ? $object->table : $this->table;

    $req = new stdClass();
    $req->sql = "UPDATE $table SET $v $object->conditions";
    $req->data = empty($object->data) ? [] : $object->data;

    $this->query($req);
  }

  // delete
  public function delete($req)
  {
    $this->query($req);
  }



  public function fetch($sql, $data = array())
  {
    $req = $this->DB->prepare($sql);
    $req->execute($data);
    return $req->fetchALL(PDO::FETCH_OBJ);
  }





  // todo a supprimer
  public function get($conditions = "", $join = array(), $colonne = array(), $data = array())
  {
    $c = count($colonne) < 1  ? "*" : implode(",", $colonne);
    $j = count($join) < 1  ? "" : implode(" ", $join);
    $req = $this->DB->prepare("SELECT $c FROM $this->table $j $conditions");
    //var_dump($req);
    //var_dump($data);
    $req->execute($data);
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
