<?php
class LOG extends DB
{
  public const IN_MSG = "heureux de vous retrouver";
  public const IN_NAME = "Se connecter";
  public const IN_ALT = 'Connectez-vous';
  public const UP_MSG = "Bienvenue dans la team " . SITE::TITLE;
  public const UP_NAME = "S'inscrire";
  public const UP_ALT = "Inscrivez-vous";
  public const ACTIVE = " bg-gold text-white font-weight-bold mx-auto col ndrt-hover ";
  public const INACTIVE = " bg-dark text-gold mx-auto col ndrt-hover ";
  public const LINK = " nav-link rounded-0 w-100 m-0 ";
  public const LOG = "SELECT id, ref, password, role, mail, username, nom, prenom FROM user";
  public $IN_MSG = "heureux de vous retrouver";
  public $IN_NAME = "se connecter";
  public $IN_ALT = 'Connectez-vous';
  public $UP_MSG = "bienvenue dans la team " . SITE::TITLE;
  public $UP_NAME = "s'inscrire";
  public $UP_ALT = "Inscrivez-vous";
  public $ACTIVE = " bg-gold text-white font-weight-bold mx-auto col ndrt-hover ";
  public $INACTIVE = " bg-dark text-gold mx-auto col ndrt-hover ";
  public $LINK = " nav-link rounded-0 w-100 m-0 ";
  public $LOG = "SELECT id, ref, password, role, mail, username, nom, prenom FROM user";

  public function logUser($user)
  {
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
