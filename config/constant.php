<?php
interface ALL
{
  public const FALSE = 0;
  public const TRUE = 1;
  public const TABLE = [
    'adresse' => 'adresse',
    'category' => 'category',
    'categoryType' => 'category_type',
    'country' => 'country',
    'img' => 'img',
    'mail' => 'mail',
    'orders' => 'orders',
    'ordersStatus' => 'orders_status',
    'product' => 'product',
    'role' => 'role',
    'user' => 'user'
  ];
}

interface SQL
{
  public const RAND = " order by rand()";
}

interface OPTION
{
  public const UPLOAD_FILE_MAXSIZE = 3000000;
  public const SLIDE = 50 * 1000;
  public const POPUP = 'width=600,height=800';
  public const HASH = ['cost' => 12];
}

interface IMG
{
  public const LOGO = "https://i.imgur.com/CzSaJ6O.png";
  public const LOST = "https://i.imgur.com/Mx9HjOI.png";
  public const FOLDER = array(
    "category" => "CATY",
    "site" => "SITE",
    "product" => "PROD",
    "user" => "USER"
  );
}

interface CONTACT
{
  public const MAIL = "contact@ndrt.com";
  public const INSTAGRAM = "https://www.instagram.com/";
  public const FACEBOOK = "https://www.facebook.com/";
  public const TWITTER = "https://twitter.com/";
}

interface CSS
{
  public const BOOTSTRAP = "./css/bootstrap.css";
  public const STYLE = "./css/style.css";
}

interface SCRIPT
{
  public const SCRIPT = "./js/script.js";
  public const BOOTSTRAP = "./js/bootstrap.js";
  public const FONTAWSOME = "./js/fontawsome.js";
  public const JQUERY = "./js/jquery.js";
  public const JQUERY_VALIDATE = "./js/jquery-validate.js";
  public const BOOTSTRAP_VALIDATOR = "./js/jquery-validate.js";
  public const REGEX = './js/validate-regex.js';
  public const MAIL_ADMIN = './js/admin/js-mail.js';
}

interface ICON
{
  public const LOGIN = '<i class="fas fa-sign-in-alt"></i>';
  public const LOGOUT = '<i class="fas fa-sign-out-alt"></i>';
  public const USER = '<i class="fas fa-user"></i>';
  public const USER_CIRCLE = '<i class="fas fa-user-circle"></i>';
  public const PLUS = '<i class="fas fa-plus"></i>';
  public const EYE = '<i class="fas fa-eye"></i>';
  public const EDIT = '<i class="fas fa-pen"></i>';
  public const BACK = '<i class="fas fa-long-arrow-alt-left"></i>';
  public const INSTAGRAM = '<i class="fab fa-instagram"></i>';
  public const FACEBOOK = '<i class="fab fa-facebook-f"></i>';
  public const TWITTER = '<i class="fab fa-twitter"></i>';
  public const CRCLE = '<i class="fas fa-circle"></i>';
  public const CROSS = '<i class="fas fa-times"></i>';
  public const REFRESH = '<i class="fas fa-sync"></i>';
  public const SEARCH = '<i class="fas fa-search"></i>';
  public const CART = '<i class="fas fa-shopping-bag"></i>';
  public const POWER = '<i class="fas fa-power-off"></i>';
  public const INVOICE = '<i class="fas fa-receipt"></i>';

  public const INBOX = '<i class="fas fa-inbox"></i>';

  public const READ = '<i class="fas fa-envelope-open"></i>';
  public const UNREAD = '<i class="fas fa-envelope"></i>';

  public const STAR = '<i class="fas fa-star"></i>';
  public const UNSTAR = '<i class="far fa-star"></i>';

  public const ARCHIVE = '<i class="fas fa-archive"></i>';
  public const TOARCHIVE = '<i class="fas fa-folder-plus"></i>';
  public const UNARCHIVE = '<i class="fas fa-folder-minus"></i>';

  public const TRASH = '<i class="fas fa-trash"></i>';
  public const RECYCLE = '<i class="fas fa-recycle"></i>';

  public const TRACK = '<i class="fas fa-truck-moving"></i>';
}

interface REGEX
{
  public const PHONE = '/^[+0-9]{8,20}$/';
  public const ZIP = '/^[0-9]{4,5}$/';
  public const PASS = '/^([a-zA-Z]{1,}|[0-9]{1,}){6,}$/';
  public const PRICE = '/^[0-9]+(\.[0-9]{2})?$/';
  public const NUMBER = '/^[a-zA-Z\d]+$/';
  public const MAIL = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
  public const USERNAME = '/^[a-zA-Z0-9_]{3,16}$/';
  public const WORDS =  '/[a-zA-Z\'-.\s]{1,}$/';
  public const W_N = "/[a-zA-Z0-9\'-.\s]{1,}$/";
  public const TEXT =  '/[a-zA-Z0-9\'\/\s ²~"#|()-`\^@+=,?;.:!°*€¨%$£µ]{1,}$/';
  public const SPLIT = '/[\s,-]+/';
}

interface STYLE
{
  public const NO_BDR_AND_RND = " rounded-0 border-0 ";
  public const FOOTER_LINK = " text-gold text-uppercase h6 m-0 px-1 text-decoration-none ";
  public const BREADCRUMB = " breadcrumb bg-dark my-3 " . self::NO_BDR_AND_RND;
  public const BREADCRUMB2 = " bg-dark my-3 " . self::NO_BDR_AND_RND;
  public const PRODUCT = " card h-100 m-0 p-0 bg-transparent h-100 " . self::NO_BDR_AND_RND;
  public const SLIDER_TEXT = " text-gold font-weight-bolder h3 text-uppercase text-center ndrtText p-0 bg-white py-5 w-50 mx-auto ndrt-hover justify-content-center ";
  public const BAR_LINK = "m-0 px-2 text-decoration-none ";

  public const ADMIN_BUTTON = " btn p-0 w-100 text-white " . self::NO_BDR_AND_RND;
  public const ADMIN_TITLE = "text-center bg-dark text-white w-100 text-uppercase h3";
  public const ADMIN_TITLE_BG = "bg-dark text-white p-2";
  public const ADMIN_MENU = "text-decoration-none text-dark small py-0 px-1 m-0";

  public const MAIL_TITLE = " btn btn-link text-decoration-none text-white btn-block bg-gold " . self::NO_BDR_AND_RND;
  public const MAIL_EMPTY = " p-5 m-0 text-dark h3 text-center border-bottom border-secondary ";
  public const MAIL_LINK_MENU = "nav-link text-dark " . self::NO_BDR_AND_RND;

  public const LOGIN_ACTIVE = " bg-gold text-white font-weight-bold mx-auto col ndrt-hover ";
  public const LOGIN_INACTIVE = " bg-dark text-gold mx-auto col ndrt-hover ";
  public const LOGIN_LINK = " nav-link rounded-0 w-100 m-0 ";

  public const BUTTON_ACTION = "text-dark mx-1 text-decoration-none pointer";
  public const NAV_MENU_BTN = 'text-dark fa-2x text-center pointer px-2';
  public const PROGRESS_BAR = 'progress-bar progress-bar-striped progress-bar-animated';

  public const ORDER_CARD_COL = 'col-md-5 col-10 card bg-transparent' . self::NO_BDR_AND_RND;
  public const ORDER_PROD_COL = 'col-11 card bg-transparent' . self::NO_BDR_AND_RND;
}

interface CATEGORY_CONST
{

  public const PRINCIPAL = [
    "id" => 1,
    "name" => "Principale",
    "bg" => "dark",
    "txt" => "gold"
  ];

  public const SECONDAIRE = [
    "id" => 2,
    "name" => "Secondaire",
    "bg" => "warning",
    "txt" => "dark"
  ];

  public const COLLECTION =
  [
    "id" => 3,
    "name" => "Collection",
    "bg" => "success",
    "txt" => "white"
  ];

  public const HOME = [
    'type' => self::PRINCIPAL['id'],
    'limit' => 4
  ];



  public const CAT_ID = 1;
  public const ALT_ID = 2;
  public const COL_ID = 3;
  public const CAT_NAME = "Principale";
  public const COL_NAME = "Collection";
  public const ALT_NAME = "Secondaire";

  public const ALL = "TOUS NOS PRODUITS";
}

interface SOCIETY
{
  public const NAME = "NDRT SAS";
  public const ADRESSE = "1 avenue de la paix";
  public const ZIP = "75001";
  public const CITY = "Paris";
  public const COUNTRY = "Frane";
  public const SIRET = "830 075 093 00000";
  public const RCS =  "PARIS";
  public const TVA = "FR0000007593";
  public const RS = "NDRT Europe";
}



interface USER_CONST
{
  public const REMISE = 15;
  public const ADMIN_ID = 0;
  public const DIRECTION_ID = 1;
  public const LEADER_ID = 2;
  public const COLLABORATEUR_ID = 3;
  public const CLIENT_ID = 4;
}

interface MAIL_CONST
{
  public const ACTIVED = [
    "key" => "all",
    "name" => "Tous les messages",
    "message" => "Pas de messages.",
    "read" => array(ALL::TRUE, ALL::TRUE),
    "active" => array(ALL::TRUE),
    "archive" => array(ALL::FALSE),
    "save" => array(ALL::TRUE, ALL::FALSE),
    "list" => []
  ];

  public const READED = [
    "key" => "readed",
    "name" => "Messages lus.",
    "message" => "Pas de messages.",
    "read" => array(ALL::TRUE),
    "active" => array(ALL::TRUE),
    "archive" => array(0),
    "save" => array(ALL::TRUE, ALL::FALSE),
    "list" => []
  ];

  public const UNREADED = [
    "key" => "unreaded",
    "name" => "Messages Non lus.",
    "message" => "Pas de nouveaux messages.",
    "read" => array(ALL::FALSE),
    "active" => array(ALL::TRUE),
    "archive" => array(ALL::FALSE),
    "save" => array(ALL::TRUE, ALL::FALSE),
    "list" => []
  ];

  public const ARCHIVED = [
    "key" => "archived",
    "name" => "Messages archivés.",
    "message" => "Pas de messages.",
    "read" => array(ALL::TRUE, ALL::FALSE),
    "active" => array(ALL::TRUE),
    "archive" => array(ALL::TRUE),
    "save" => array(ALL::TRUE, ALL::FALSE),
    "list" => []
  ];

  public const SAVED = [
    "key" => "saved",
    "name" => "Messages enregistrés.",
    "message" => "Pas de messages.",
    "read" => array(ALL::TRUE, ALL::FALSE),
    "active" => array(ALL::TRUE),
    "archive" => array(ALL::FALSE),
    "save" => array(ALL::TRUE),
    "list" => []
  ];

  public const INACTIVED = [
    "key" => "inactived",
    "name" => "Corbeille",
    "message" => "Corbeill vide",
    "read" => array(ALL::TRUE, ALL::FALSE),
    "active" => array(ALL::FALSE),
    "archive" => array(ALL::TRUE, ALL::FALSE),
    "save" => array(ALL::TRUE, ALL::FALSE),
    "list" => []
  ];
}
