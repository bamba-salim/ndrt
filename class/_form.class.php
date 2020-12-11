<?php
class FORM extends DB implements REGEX, IMG
{


  public function passInput($pass, $verif)
  {
    return $pass !== $verif || empty($pass) || !preg_match(REGEX::PASS, $pass);
  }

  public function usedInput($input, $count, $regex)
  {
    return $count == 0 || empty($input) || !preg_match($regex, $input);
  }

  public function newInput($input, $regex)
  {
    if (empty($input) || !preg_match($regex, $input) || $input == null) {
      return true;
    } else {
      return false;
    }
  }

  public function inputNotReq($input, $regex)
  {
    if (!empty($input) && !preg_match($regex, $input)) {
      return true;
    } else {
      return false;
    }
  }

  public function formatInput($input)
  {
    $input = trim(htmlspecialchars($input));
  }

  function getImgPath($isset, $type, $name, $ref, $MSG = "")
  {
    if (isset($isset)) {

      $maxSize = self::UPLOAD_FILE_MAXSIZE;
      $validExt = array('.jpg', '.jpeg', '.png');
      $fileName = $_FILES[$name]['name'];
      $fileSize = $_FILES[$name]['size'];
      $tmpName = $_FILES[$name]['tmp_name'];
      $fileExt  = $this->getExtension($fileName);
      $uniqueName = $this->imgName($ref);



      if ($_FILES[$name]['error'] > 0) {
        $errors['down'] = "une erreur est survenue lors du téléchargement";
      } else {
        if ($fileSize > $maxSize) {
          $errors['size'] = "le fichier est trop volumineux";
        } else {
          if (!in_array($fileExt, $validExt)) {
            $errors['type'] = "le fichier n'est pas une image";
          }
        }
      }
      if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
      } else {
        $filePath = "./asset/img/{$type}/" . $uniqueName . $fileExt;
        move_uploaded_file($tmpName, $filePath);
        $_SESSION['success'] = $MSG;
        $value['p'] = $filePath;
        $value['u'] = $uniqueName;
        return $value;
      }
    }
  }
}
