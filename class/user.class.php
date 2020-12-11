<?php
class USER extends DB implements USER_CONST
{
    public $table = self::TABLE['user'] . " as u";

    //colonnes
    public const COLONNES = "u.id, u.ref, u.username, u.nom, u.prenom, u.mail, u.created_at, u.role as roleId";
    public const ACCOUNT_STATUS = "u.is_vip as vip, u.is_blocked as blocked, u.is_active as active";

    // role
    public const JOIN_ROLE = "JOIN role as r on r.id = u.role";
    public const COL_ROLE = "r.name as role";

    public const SELECT = "SELECT u.username, r.name as role, u.ref, u.nom, u.prenom, u.mail, u.created_at FROM user AS u JOIN role as r on r.id = u.role";
    public const CREATE = "INSERT INTO user (role, ref, username, nom, prenom, mail, password) VALUES (:role, :ref, :username, :nom, :prenom, :mail, :password)";
    public const CHECK = "SELECT id FROM user WHERE ref=:ref OR username=:ref or mail=:ref";

    public function getUserList($object = [])
    {
        $conditions = "";
        $test = "";
        $blocked = false;

        extract($object);

        if (!empty($role)) {
            $conditions = "where u.role = :test";
            $test = $role;
        }

        if (!empty($vip)) {
            $conditions = "where u.is_vip = :test";
            $test = $vip;
        }

        if (!empty($blocked)) {
            $conditions = "where u.is_blocked = :test";
            $test = $blocked;
        }

        $req = [
            'conditions' => "$conditions order by u.is_active desc , u.is_blocked",
            'data' => [':test' => $test],
        ];

        $newReq = new stdClass();
        $newReq->conditions = "$conditions order by u.is_active desc , u.is_blocked";
        $newReq->data = [':test' => $test];

        $list = $this->select($req);
        return empty($list) ? null : $list;
    }

    // fetch user à refaire
    public function getUser($test = "")
    {
        if (empty($test)) {
            $test = $this->account->id;
        }

        $ORDER = new ORDER();
        $user = new stdClass();
        $req = [
            'conditions' => "WHERE u.ref = :test or u.id = :test or u.username = :test",
            'data' => [':test' => $test],
            'colonnes' => [self::COLONNES, self::COL_ROLE, self::ACCOUNT_STATUS],
            'join' => [self::JOIN_ROLE],
        ];

        $newReq = new stdClass();
        $newReq->conditions = "WHERE u.ref = :test or u.id = :test";
        $newReq->join = [self::JOIN_ROLE];
        $newReq->colonnes = [self::COLONNES, self::COL_ROLE, self::ACCOUNT_STATUS];
        $newReq->data = [':test' => $test];

        $info = $this->select($req);

        if (count($info) == 1) {
            $user->info = $info[0];
            $user->order = $ORDER->getOrdersTotals($user->info->id);
        }

        //var_dump($user);

        //$user = $this->select($req);
        return !empty($user) ? $user : null;
    }

    // get user role name
    public function getRole($role)
    {

        $req = [
            'table' => self::TABLE['role'] . " as r",
            'conditions' => "where r.id = :id",
            'data' => [':id' => $role],
        ];

        $newReq = new stdClass;
        $newReq->table = self::TABLE['role'] . " as r";
        $newReq->conditions = "where r.id = :id";
        $newReq->data = [':id' => $role];

        $name = $this->select($req);
        return !empty($name) ? $name[0]->name : null;
    }

    public function creatUser($user)
    {
        $req = new stdClass();
        $req->table = self::TABLE['user'];
        $req->colonnes = ["ref", "username", "nom", "prenom", "mail", "password", "role", "created_at"];
        $req->values = [":ref", ":username", ":nom", ":prenom", ":mail", ":password", ":role", ":created_at"];
        $req->data = [":ref" => $user->ref, ":username" => $user->username, ":nom" => $user->nom, ":prenom" => $user->prenom, ":mail" => $user->mail, ":password" => $user->password, ":role" => $user->role, ":created_at" => $this->date];
        $this->create($req);
    }

    public function logUser($test)
    {
      $user = $this->getUser($test)->info;
      $account = new stdClass();
      $account->log = true;
      $account->id = $user->id;
      $account->ref = $user->ref;
      $account->username = $user->username;
      $account->mail = $user->mail;
      $account->role = $user->role;
      $account->idRole = $user->roleId;
      return $account;
    }
}
