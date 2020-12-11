<?php
class MAIL extends DB implements ICON, MAIL_CONST
{

  public $table = self::TABLE['mail'] . " as m";

  // SQL
  private const SEND = "INSERT INTO mail (name,msg,sujet,mail,ref) VALUES (:name,:msg,:sujet,:mail,:ref)";
  private const STATUS = "is_read as readed, is_active as actived, is_archive as archived, is_save as saved";
  private const INFO = "*";


  public function SEND($name, $message, $sujet, $mail, $ref)
  {
    $this->query2(self::SEND, array(':name' => $name, ':msg' => $message, ':sujet' => $sujet, ':mail' => $mail, ':ref' => $ref));
  }

  public function readStatuts($status)
  {
    return $status == self::TRUE ? "<span class='text-danger'>" . self::CRCLE . "</span>" : "";
  }

  public function readMail($object)
  {

    $c = count($this->getMailsList($object));

    switch ($c):
      case 0;
        return 'Pas de nouveaux messages.';
        break;
      case 1;
        return '1 message non-lu.';
        break;
      case  $c > 1;
        return $c . ' messages non-lus.';
        break;
    endswitch;
  }

  public function getMailsList($object)
  {
    extract($object);
    return $this->get(
      "WHERE is_read in (:read) and is_active in (:active) and is_archive in (:archive) and is_save in (:save)",
      array(),
      array(
        self::INFO,
        self::STATUS
      ),
      array(
        ":read" => implode(",", $read),
        ":active" => implode(",", $active),
        ":archive" => implode(",", $archive),
        ":save" => implode(",", $save)
      )
    );
  }

  public function getMail($ref)
  {
    return $this->get(
      "where ref = :ref",
      array(),
      array(
        self::INFO,
        self::STATUS
      ),
      array(
        ":ref" => $ref
      )
    )[0];
  }

  public function gestionArchiveStatut($object)
  {
    extract($object);
    $this->update(
      "where ref = :ref",
      array(
        "is_archive = :set"
      ),
      array(
        ":ref" => $ref,
        ":set" => $set
      )
    );
  }

  public function gestionReadStatut($object)
  {
    extract($object);
    $this->update(
      "where ref = :ref",
      array(
        "is_read = :set"
      ),
      array(
        ":ref" => $ref,
        ":set" => $set
      )
    );
  }

  public function gestionActiveStatut($object)
  {
    extract($object);
    $this->update(
      "where ref = :ref",
      array(
        "is_active = :set"
      ),
      array(
        ":ref" => $ref,
        ":set" => $set
      )
    );
  }


  // todo: à refaire
  public function deleteMail($object)
  {
    extract($object);
    $ref = isset($ref) && $ref != null ? $ref : "";
    $id = isset($id) && $id != null ? $id : "";

    $req = new stdClass();
    $req->sql = "where ref = :test or id = :test";
    $req->data = ["test" => $test];

    $this->delete($req);
  }
}
