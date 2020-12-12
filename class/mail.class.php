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

  public function getAllList()
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

  public function getUnreadList()
  {
    $req = new stdClass();
    $req->conditions = "WHERE is_read = 0 and is_active = 1 and is_archive = 0 and is_save = 0 order by created_at DESC";
    $req->colonnes = ["m.*", self::STATUS];

    $req = [
      "conditions" => "WHERE is_read = 0 and is_active = 1 and is_archive = 0 and is_save = 0 order by created_at DESC",
      "colonnes" => ["m.*", self::STATUS],
    ];

    return $this->select($req);
  }

  public function unreadList()
  {
    $lenList = count($this->getUnreadList());

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



  public function gestionStatut($object)
  {

    // archive | unarchive
    $values = isset($object->archive) ? "is_archive = :set" : "";
    $values = isset($object->unarchive) ? "is_archive = :set" : "";
    // read | unread
    $values = isset($object->read) ? "is_read = :set" : "";
    $values = isset($object->unread) ? "is_read = :set" : "";
    // save | unsave
    $values = isset($object->save) ? "is_save = :set" : "";
    $values = isset($object->unsave) ? "is_save = :set" : "";
    // active | inactive
    $values = isset($object->active) ? "is_active = :set" : "";
    $values = isset($object->inactive) ? "is_active = :set" : "";
    
    $req = new stdClass();

    $req->table = self::TABLE['mail'];
    $req->conditions = "where id = :id";
    $req->values = [$values];
    $req->data = [":id" => $object->id, ":set" => $object->set];

    $this->update($req);
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
          <table class="table table-striped table-borderless">
            <tbody>
              <?php foreach ($list as $mail) : ?>
                <tr>
                  <th scope="row">
                    <span <?= $this->hidden($mail->readed) ?>>
                      <div class="d-inline text-danger d-none"><?= ICON::CIRCLE ?></div>
                    </span>
                    <span <?= $this->hidden(!$mail->readed) ?>>
                      <div class="d-inline text-dakr d-none" onclick="unreadMail(<?= $mail->id ?>)"><?= ICON::UNCIRCLE ?></div>
                    </span>
                    <span <?= $this->hidden(!$mail->saved) ?>>
                      <div class="d-inline text-warning" onclick="unsaveMail(<?= $mail->id ?>)"><?= ICON::STAR ?></div>
                    </span>
                    <span <?= $this->hidden($mail->saved) ?>>
                      <div class="d-inline text-dark" onclick="saveMail(<?= $mail->id ?>)"><?= ICON::UNSTAR ?></div>
                    </span>
                    <div class="ml-2 d-inline"><?= $mail->name ?> - <a class="text-muted font-italic text-decoration-none" href="mailto:<?= $mail->mail ?>"><?= $mail->mail ?></a> - <span class="text-muted"><?= $mail->sujet ?></span> </div>
                  </th>
                  <td class="text-right"><?= $this->switchDateFormat($mail->created_at) ?></td>
                  <td class="text-right">
                    <a onclick="viewMail(<?= $mail->id ?>)" class="pointer"><?= ICON::EYE ?></a>
                    <a onclick="archiveMail(<?= $mail->id ?>)" class="pointer"><?= ICON::ARCHIVE ?></a>
                    <a onclick="unarchiveMail(<?= $mail->id ?>)" class="pointer"><?= ICON::UNARCHIVE ?></a>
                    <a onclick="inactiveMail(<?= $mail->id ?>)" class="pointer"><?= ICON::TRASH ?></a>
                  </td>
                </tr>

                <div class="modal fade" id="updateModal<?= $mail->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <p id="textUpdate<?= $mail->id ?>"></p>
                        <p id="updateVal<?= $mail->id ?>"></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateBtn" onclick="comfirmUpdate(<?= $mail->id ?>)">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </tbody>
          </table>
          <p <?= $this->hidden(!empty($list)) ?> class="text-center h4 text-dark"><?= $message ?></p>
        </div>
      </div>

    </div>
<?php }
}
