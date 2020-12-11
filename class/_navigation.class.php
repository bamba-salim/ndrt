<?php

class NAV extends DB implements USER_CONST
{
  

  private const ADMIN = [self::ADMIN_ID];
  private const DIRECTION = [self::ADMIN_ID, self::DIRECTION_ID];
  private const LEADER = [self::ADMIN_ID, self::DIRECTION_ID, self::LEADER_ID];
  private const COLLAB = [self::ADMIN_ID, self::DIRECTION_ID, self::LEADER_ID, self::COLLABORATEUR_ID];
   

  public function __construct()
  {
    extract($_SESSION);
    if (isset($user))  $this->account = $user;
  }

  public function redirect($verif)
  {
    if (!$verif) {
      header('location: ./');
      exit();
    }
  }
  public function goHome($verif)
  {
    if ($verif) {
      header('header: ./');
      exit();
    }
  }

  public function goBack()
  {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
  }

  public function isLog()
  {
    // var_dump($this->account);
    if (isset($this->account->log)) {
      return $this->account->log == true;
    }
  }

  public function isAdmin()
  {
    if (isset($this->account->idRole)) {
      return  in_array($this->account->idRole, self::ADMIN);
    }
  }
  public function isDir()
  {
    if (isset($this->account->idRole)) {
      return in_array($this->account->idRole, self::DIRECTION);
    }
  }

  public function isLeader()
  {
    if (isset($this->account->idRole)) {
      return in_array($this->account->idRole, self::LEADER);
    }
  }

  public function isCollab()
  {

    if (isset($this->account->idRole)) {

      return in_array($this->account->idRole, self::COLLAB);
    }
  }


  public function notFound($text = "IL SEMBLE QU'IL N'Y EST RIEN ICI")
  {
    echo "
    <div class='jumbotron jumbotron-fluid my-3 bg-white text-gold text-center'>
    <h1 class='display-4'>OUPS</h1><img src='" . self::LOST . "' alt='404' class='w-50'>
    <p class='text-gold text-center display-4'>$text</p>
    </div>
    ";
  }
}
