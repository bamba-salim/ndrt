<table class="table table-striped table-borderless">
  <tbody>
    <?php foreach ($list as $mail) : ?>
      <tr>

        <th scope="row">
          <!-- unread icon -->
          <a <?= $this->hidden($mail->readed) ?> class="pointer text-danger"><?= ICON::CIRCLE ?></a>
          <!-- saved icon -->
          <a <?= $this->hidden(!$mail->saved || !$mail->actived || $mail->archived) ?> class="pointer text-warning" onclick="unsaveMail(<?= $mail->id ?>)"><?= ICON::STAR ?></a>
          <!-- read icon -->
          <a <?= $this->hidden(!$mail->readed) ?> class="pointer" onclick="unreadMail(<?= $mail->id ?>)"><?= ICON::UNCIRCLE ?></a>
          <!-- unsave icon -->
          <a <?= $this->hidden($mail->saved || !$mail->actived || $mail->archived) ?> class="pointer" onclick="saveMail(<?= $mail->id ?>)"><?= ICON::UNSTAR ?></a>

          <div class="ml-2 d-inline"><?= $mail->name ?> - <a class="text-muted font-italic text-decoration-none" href="mailto:<?= $mail->mail ?>"><?= $mail->mail ?></a> - <span class="text-muted"><?= $mail->sujet ?></span> </div>
        </th>
        <td class="text-right"><?= $this->switchDateFormat($mail->created_at) ?></td>
        <td class="text-right">
          <!-- view -->
          <a onclick="viewMail(<?= $mail->id ?>)" class="pointer"><?= ICON::EYE ?></a>
          <!-- archive -->
          <a <?= $this->hidden($mail->archived || !$mail->actived || $mail->saved) ?> onclick="archiveMail(<?= $mail->id ?>)" class="pointer"><?= ICON::ARCHIVE ?></a>
          <!-- unarchive -->
          <a <?= $this->hidden(!$mail->archived || !$mail->actived || $mail->saved) ?> onclick="unarchiveMail(<?= $mail->id ?>)" class="pointer"><?= ICON::UNARCHIVE ?></a>
          <!-- inactive -->
          <a <?= $this->hidden(!$mail->actived) ?> onclick="inactiveMail(<?= $mail->id ?>)" class="pointer"><?= ICON::TRASH ?></a>
          <!-- recylcle -->
          <a <?= $this->hidden($mail->actived) ?> onclick="activeMail(<?= $mail->id ?>)" class="pointer text-success"><?= ICON::RECYCLE ?></a>
          <!-- delete -->
          <a <?= $this->hidden($mail->actived) ?> onclick="deleteMail(<?= $mail->id ?>,'delete')" class="pointer text-danger"><?= ICON::TRASH ?></a>
        </td>
      </tr>

      <!-- ##### modal view mail ###### -->
      <a id="OpenDialog" href="#">Click here to open dialog</a>
<div id="dialog" title="Dialog Title">
    <p>test</p>
</div>
      <!-- ##### modal archive mail ###### -->
      <div class="modal fade" id="view-modal-<?= $mail->id ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Archiver <?= $mail->ref ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?php var_dump($mail); ?>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="button" class="btn btn-primary" id="updateBtn" onclick="comfirmUpdate(<?= $mail->id ?>,'archive')">Confirmer</button>
            </div>
          </div>
        </div>
      </div>

      <!-- ##### modal inactive mail ###### -->
      <div class="modal fade" id="inactive-modal-<?= $mail->id ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Effacer <?= $mail->ref ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <p>Souhaitez vous effacer <?= $mail->ref ?> ?</p>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="button" class="btn btn-primary" id="updateBtn" onclick="comfirmUpdate(<?= $mail->id ?>,'inactive')">Confirmer</button>
            </div>
          </div>
        </div>
      </div>

      <?php unset($_COOKIE) ?>
    <?php endforeach; ?>
  </tbody>
</table>