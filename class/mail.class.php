<?php
class MAIL extends DB implements ICON, MAIL_CONST
{

    public $table = self::TABLE['mail'] . " as m";

    // SQL
    private const SEND = "INSERT INTO mail (name,msg,sujet,mail,ref) VALUES (:name,:msg,:sujet,:mail,:ref)";
    private const STATUS = "m.is_read as readed, m.is_active as actived, m.is_archive as archived, m.is_save as saved";
    private const INFO = "m.*";

    public function SEND($name, $message, $sujet, $mail, $ref)
    {
        $this->query2(self::SEND, array(':name' => $name, ':msg' => $message, ':sujet' => $sujet, ':mail' => $mail, ':ref' => $ref));
    }

    public function readStatuts($status)
    {
        return $status == self::TRUE ? "<span class='text-danger'>" . self::CRCLE . "</span>" : "";
    }

    public function unreadMail()
    {

        $c = $this->getUnreadList();

        if (count($c) == 0) {
            return "Pas de nouveaux messages.";
        } elseif (count($c) == 1) {
            return '1 message non-lu.';
        } else {
            return count($c) . " messages non-lus.";
        }

    }

    public function getUnreadList($user = null)
    {
        if ($user) {
            return "";
        }

        $req = new stdClass();
        $req->conditions = "WHERE is_read = 0 and is_active = 1 and is_archive = 0 and is_save = 1";
        $req->colonnes = [self::INFO, self::STATUS];

        $req = [
            'conditions' => "WHERE is_read = 0 and is_active = 1 and is_archive = 0 and is_save = 1",
            'colonnes' => [self::INFO, self::STATUS],
        ];

        $list = $this->select($req);
        // var_dump($list);
        return $list;
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

    public function gestionStatus($object)
    {
        # code...
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
}
