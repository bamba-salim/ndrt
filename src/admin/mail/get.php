<?php
$MAIL = new MAIL();
$NAV = new NAV();

?>
<div class="container">
  <div class="row my-4">
    <div class="col-3">
      <div class="nav flex-column nav-pills" id="mails-tab" role="tablist" aria-orientation="vertical">
        <a class="<?=STYLE::MAIL_LINK_MENU?> active" id="unreaded-tab" data-toggle="pill" href="#unreaded" role="tab" aria-controls="unreaded" aria-selected="true">Non-lus.</a>
        <a class="<?=STYLE::MAIL_LINK_MENU?>" id="readed-tab" data-toggle="pill" href="#readed" role="tab" aria-controls="readed" aria-selected="false">Lus</a>
        <a class="<?=STYLE::MAIL_LINK_MENU?>" id="archived-tab" data-toggle="pill" href="#archived" role="tab" aria-controls="archived" aria-selected="false">Archivés</a>
        <a class="<?=STYLE::MAIL_LINK_MENU?>" id="saved-tab" data-toggle="pill" href="#saved" role="tab" aria-controls="saved" aria-selected="false">Important</a>
        <a class="<?=STYLE::MAIL_LINK_MENU?>" id="trashed-tab" data-toggle="pill" href="#trashed" role="tab" aria-controls="trashed" aria-selected="false">Corbeille</a>
      </div>
    </div>
    <div class="col-9">
      <div class="tab-content" id="mails-tabContent">
        <div class="tab-pane fade show active" id="unreaded" role="tabpanel" aria-labelledby="unreaded-tab">
          Non-lus
        </div>
        <div class="tab-pane fade" id="readed" role="tabpanel" aria-labelledby="readed-tab">
          Lus
        </div>
        <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
          Archivés
        </div>
        <div class="tab-pane fade" id="saved" role="tabpanel" aria-labelledby="saved-tab">
          Important
        </div>
        <div class="tab-pane fade" id="trashed" role="tabpanel" aria-labelledby="trashed-tab">
          Corbeille
        </div>
      </div>
    </div>
  </div>
</div>

