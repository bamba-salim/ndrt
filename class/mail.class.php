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

  public function getUnreadList()
  {
    $req = new stdClass();
    $req->conditions = "WHERE is_read = 0 and is_active = 1 and is_archive = 0 and is_save = 0";
    $req->colonnes = ["m.*", self::STATUS];

    $req = [
      "conditions" => "WHERE is_read = 0 and is_active = 1 and is_archive = 0 and is_save = 0",
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

  public function getMailsList($object)
  {
    extract($object);
    return $this->get(
      "WHERE is_read in (:read) and is_active in (:active) and is_archive in (:archive) and is_save in (:save)",
      array(),
      array(
        self::INFO,
        self::STATUS,
      ),
      array(
        ":read" => implode(",", $read),
        ":active" => implode(",", $active),
        ":archive" => implode(",", $archive),
        ":save" => implode(",", $save),
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
        self::STATUS,
      ),
      array(
        ":ref" => $ref,
      )
    )[0];
  }

  public function gestionArchiveStatut($object)
  {
    extract($object);
    $this->update(
      "where ref = :ref",
      array(
        "is_archive = :set",
      ),
      array(
        ":ref" => $ref,
        ":set" => $set,
      )
    );
  }

  public function gestionReadStatut($object)
  {
    extract($object);
    $this->update(
      "where ref = :ref",
      array(
        "is_read = :set",
      ),
      array(
        ":ref" => $ref,
        ":set" => $set,
      )
    );
  }

  public function gestionActiveStatut($object)
  {
    extract($object);
    $this->update(
      "where ref = :ref",
      array(
        "is_active = :set",
      ),
      array(
        ":ref" => $ref,
        ":set" => $set,
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

  public function mailsList($object)
  { ?>
    <div class="row row-cols-1">
      <div class="col">
        <div class="card alert alert-light bg-dark rounded-0 shadow-sm p-0">
          <div class="pt-3">
            <p class='lead text-uppercase text-white text-center p-0'> <?= $object->title ?></p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card alert alert-light rounded-0 shadow-sm" role="alert">
          <table class="table table-striped table-borderless">
            <thead>
              <tr>
                <th scope="col">Mail</th>
                <th scope="col">date</th>
                <th scope="col" class="text-right">action</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($object->list as $mail) : ?>
                <tr>
                  <th scope="row">
                    <div class="d-inline text-danger"><?= ICON::CIRCLE ?></div>
                    <div class="d-inline text-warning"><?= ICON::STAR ?></div>
                    <div class="d-inline text-dark"><?= ICON::UNSTAR ?></div>
                    <div class="d-inline">client - object</div>
                  </th>
                  <td>date</td>
                  <td class="text-right">
                    <a href=""><?= ICON::EYE ?></a>
                    <a href=""><?= ICON::STAR ?></a>
                    <a href=""><?= ICON::UNSTAR ?></a>
                    <a href=""><?= ICON::ARCHIVE ?></a>
                    <a href=""><?= ICON::UNARCHIVE ?></a>
                    <a href=""><?= ICON::TRASH ?></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <p <?= $this->hidden(!empty($object->list)) ?> class="text-center h4 text-dark"><?= $object->emptyMessage ?></p>
        </div>
      </div>

    </div>
<?php }
}
