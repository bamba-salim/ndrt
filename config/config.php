<?php
session_start();

date_default_timezone_set("Europe/Paris");

require "constant.php";


// BDD
require "./class/_general.class.php";
require "./class/__db.class.php";
$DB = new DB();
function DB()
{
  $DB = new DB();
  return $DB;
}


require "./class/adresse.class.php";
require "./class/category.class.php";
require "./class/mail.class.php";
require "./class/order.class.php";
require "./class/product.class.php";
require "./class/user.class.php";

require "./class/_admin.class.php";
require "./class/_cart.class.php";
require "./class/_form.class.php";
require "./class/_log.class.php";
require "./class/_navigation.class.php";
require "./class/_modal.class.php";
require "./class/_site.class.php";

$ADMIN = new ADMIN();
$ADRESSE = new ADRESSE();
$CART = new CART($DB);
$CATEGORY = new CATEGORY();
$FORM = new FORM();
$LOGIN = new LOG();
$MAIL = new MAIL();
$ORDER = new ORDER();
$PRODUCT = new PRODUCT();
$SITE = new SITE();
$USER = new USER();
$NAV = new NAV();

$MODAL = new MODAL();


require "module_html.php";
