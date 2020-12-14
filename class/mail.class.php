<?php
class MAIL extends DB implements ICON, MAIL_CONST
{

  public $table = self::TABLE['mail'] . " as m";

  // SQL
  private const SEND = "INSERT INTO mail (name,msg,sujet,mail,ref) VALUES (:name,:msg,:sujet,:mail,:ref)";
  private const STATUS = "is_read as readed, is_active as actived, is_archive as archived, is_save as saved";

  public function SEND($name, $message, $sujet, $mail, $ref)
  {
    $this->query2(self::SEND, array(':name' => $name, ':msg' => $message, ':sujet' => $sujet, ':mail' => $mail, ':ref' => $ref));
  }

  // get read and unread exect archive and inactive
  public function fetchAllList()
  {
    $req = new stdClass();
    $req->conditions = "WHERE 0 and is_active = 1 and is_archive = 0 order by created_at DESC";
    $req->colonnes = ["m.*", self::STATUS];

    $req = [
      "conditions" => "WHERE is_active = 1 and is_archive = 0 order by created_at DESC",
      "colonnes" => ["m.*", self::STATUS],
    ];

    return $this->select($req);
  }

  // get unread list
  public function fetchtUnreadList()
  {
    $req = new stdClass();
    $req->conditions = "WHERE is_read = 0 and is_active = 1 and is_archive = 0 order by created_at DESC";
    $req->colonnes = ["m.*", self::STATUS];

    $req = [
      "conditions" => "WHERE is_read = 0 and is_active = 1 and is_archive = 0 order by created_at DESC",
      "colonnes" => ["m.*", self::STATUS],
    ];

    return $this->select($req);
  }

  // get read list
  public function fetchReadList()
  {
    $req = new stdClass();
    $req->conditions = "WHERE is_read = 1 and is_active = 1 and is_archive = 0 order by created_at DESC";
    $req->colonnes = ["m.*", self::STATUS];

    $req = [
      "conditions" => "WHERE is_read = 1 and is_active = 1 and is_archive = 0 order by created_at DESC",
      "colonnes" => ["m.*", self::STATUS],
    ];

    return $this->select($req);
  }

  // get save list
  public function fetchSaveList()
  {
    $req = new stdClass();
    $req->conditions = "WHERE is_active = 1 and is_archive = 0 and is_save = 1 order by created_at DESC";
    $req->colonnes = ["m.*", self::STATUS];

    $req = [
      "conditions" => "WHERE is_active = 1 and is_archive = 0 and is_save = 1 order by created_at DESC",
      "colonnes" => ["m.*", self::STATUS],
    ];

    return $this->select($req);
  }

  // get archive list
  public function fetchArchiveList()
  {
    $req = new stdClass();
    $req->conditions = "WHERE is_active = 1 and is_archive = 1 and is_save = 0 order by created_at DESC";
    $req->colonnes = ["m.*", self::STATUS];

    $req = [
      "conditions" => "WHERE is_active = 1 and is_archive = 1 and is_save = 0 order by created_at DESC",
      "colonnes" => ["m.*", self::STATUS],
    ];

    return $this->select($req);
  }

  // get innactive list
  public function fetchInactiveList()
  {
    $req = new stdClass();
    $req->conditions = "WHERE is_active = 0 order by created_at DESC";
    $req->colonnes = ["m.*", self::STATUS];

    $req = [
      "conditions" => "WHERE is_active = 0 order by created_at DESC",
      "colonnes" => ["m.*", self::STATUS],
    ];

    return $this->select($req);
  }

  // get good title for unread list
  public function unreadList()
  {
    $lenList = count($this->fetchtUnreadList());

    switch ($lenList):
      case 0;
        return 'Pas de nouveaux messages.';
        break;
      case 1;
        return '1 message non-lu.';
        break;
      case $lenList > 1;
        return $lenList . ' messages non-lus.';
        break;
    endswitch;
  }

  // update mail status
  public function gestionStatut($object)
  {

    var_dump($object);

    // save | unsave
    if (isset($object->save)) $v = "is_save = 1 and is_archive = 0";
    if (isset($object->unsave)) $v = "is_save = 0";

    // read | unread
    if (isset($object->read)) $v = "is_read = 1";
    if (isset($object->unread)) $v = "is_read = 0";

    // archive | unarchive
    if (isset($object->archive)) $v = "is_archive = 1 and is_save = 0";
    if (isset($object->unarchive)) $v = "is_archive = 0";

    // active | inactive
    if (isset($object->active)) $v = "is_active = 1";
    if (isset($object->inactive)) $v = "is_active = 0";



    var_dump($v);
    $req = new stdClass();

    $req->table = self::TABLE['mail'];
    $req->conditions = "where id = $object->id";
    $req->values = [$v];


    $this->update($req);
  }

  // todo: à refaire
  public function deleteMail($id)
  {
    $req = new stdClass();
    $req->sql = "where ref = :id";
    $req->data = ["test" => $id];

    $this->delete($req);
  }

  public function deleteAllMail()
  {
    $req = new stdClass();
    $req->sql = "where is_active = 0";
    $this->delete($req);
  }

  public function mailsList($list, $title, $message)
  {

?>
    <div class="row row-cols-1">
      <div class="col">
        <div class="card alert alert-light bg-dark rounded-0 shadow-sm p-0">
          <div class="pt-3">
            <p class='lead text-uppercase text-white text-center p-0'> <?= $title ?></p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card alert alert-light rounded-0 shadow-sm" role="alert">
          <?php include "./src/module/list_mail_module.php" ?>
          <p <?= $this->hidden(!empty($list)) ?> class="text-center h4 text-dark"><?= $message ?></p>
        </div>
      </div>

    </div>
<?php }
}
