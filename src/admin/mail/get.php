<?php
$MAIL = new MAIL();
$NAV = new NAV();

$all = new stdClass();
$all->title = "Boite de reception";
$all->list = [];
$all->emptyMessage = "Voitre boîte de reception est vide";

?>

<div class=" mx-auto col-12 col-md-10 container-fluid">
  <div class="row my-5">
    <div class="col-4 col-md-2">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="<?= STYLE::MAIL_LINK_MENU ?> active" id="all-tab" data-toggle="pill" href="#all" role="tab" aria-controls="all" aria-selected="true">
          <div class="d-inline mr-2"><?= ICON::INBOX ?></div>
          <div class="d-inline">Boite de réception</div>
        </a>
        <hr />
        <a class="<?= STYLE::MAIL_LINK_MENU ?>" id="unreaded-tab" data-toggle="pill" href="#unreaded" role="tab" aria-controls="unreaded" aria-selected="true">
          <div class="d-inline mr-2"><?= ICON::UNREAD ?></div>
          <div class="d-inline">Non-lus</div>
        </a>
        <a class="<?= STYLE::MAIL_LINK_MENU ?>" id="readed-tab" data-toggle="pill" href="#readed" role="tab" aria-controls="readed" aria-selected="false">
          <div class="d-inline mr-2"><?= ICON::READ ?></div>
          <div class="d-inline">lus</div>
        </a>
        <hr />
        <a class="<?= STYLE::MAIL_LINK_MENU ?>" id="saved-tab" data-toggle="pill" href="#saved" role="tab" aria-controls="saved" aria-selected="false">
          <div class="d-inline mr-2"><?= ICON::STAR ?></div>
          <div class="d-inline">Enregistrés</div>

        </a>
        <a class="<?= STYLE::MAIL_LINK_MENU ?>" id="archived-tab" data-toggle="pill" href="#archived" role="tab" aria-controls="archived" aria-selected="false">
          <div class="d-inline mr-2"><?= ICON::ARCHIVE ?></div>
          <div class="d-inline">Archivé</div>
        </a>
        <hr />
        <a class="<?= STYLE::MAIL_LINK_MENU ?>" id="trashed-tab" data-toggle="pill" href="#trashed" role="tab" aria-controls="trashed" aria-selected="false">
          <div class="d-inline mr-2"><?= ICON::TRACK ?></div>
          <div class="d-inline">Corbeille</div>
        </a>

      </div>
    </div>
    <div class="col">
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
          <?php 

          $MAIL->mailsList($all) ?>
        </div>
        <div class="tab-pane fade" id="unreaded" role="tabpanel" aria-labelledby="unreaded-tab">Non Lus</div>
        <div class="tab-pane fade" id="readed" role="tabpanel" aria-labelledby="readed-tab">Lus</div>
        <div class="tab-pane fade" id="saved" role="tabpanel" aria-labelledby="saved-tab">Saved</div>
        <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">Archivés</div>
        <div class="tab-pane fade" id="trashed" role="tabpanel" aria-labelledby="trashed-tab">Corbeille</div>
      </div>
    </div>
  </div>
</div>