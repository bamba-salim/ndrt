<?php

class GENERAL implements ALL, STYLE, OPTION, SQL, IMG
{

  // ref generator
  public function generateRef()
  {

    $newDate = new DateTime();
    return "N" . $newDate->format('yWNHis') . rand(0, 9);
  }

  // date generator
  public function generateDate($qty = 0, $adds = "s")
  {
    if ($adds == "s") $toAdd = "seconds";
    if ($adds == "m") $toAdd = "minutes";
    if ($adds == "h") $toAdd = "hours";
    if ($adds == "D") $toAdd = "days";
    if ($adds == "W") $toAdd = "weeks";
    if ($adds == "M") $toAdd = "months";
    if ($adds == "Y") $toAdd = "yeas";

    return date_format(date_add(date_create(), date_interval_create_from_date_string("$qty $toAdd")), 'Y-m-d H:i:s');
  }

  public function year()
  {
    return strftime('%Y');
  }

  public function imgName($ref)
  {
    return 'IMG_' . $ref;
  }


  public function getExtension($fileName)
  {
    return "." . strtolower(substr(strrchr($fileName, '.'), 1));
  }


  public function getExt($fileName)
  {
    return strtolower(substr(strrchr($fileName, '.'), 1));
  }

  public function hidden($expression)
  {
    return $expression ? "hidden" : "";
  }

  public function DATE($date)
  {
    return date_format(date_create($date), "M j, Y");
  }

  public function HOUR($date)
  {
    return date_format(date_create($date), 'i:H');
  }


  public function PRICE($price)
  {
    $value = new stdClass();
    $value->bill = number_format($price, 2, ',', ' ');
    $value->currency = number_format($price, 2, ',', ' ') . " €";
    return $value;
  }

  // $order->created_at = date_format(date_create(), 'Y-m-d H:i:s');
  // $order->predict_at = date_format(date_add(date_create(), date_interval_create_from_date_string('3 days')), 'Y-m-d H:i:s');
}
