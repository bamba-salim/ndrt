<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
  <?php $MAIL->mailsList($MAIL->fetchAllList(), "Boite de reception", "Voitre boîte de reception est vide")?>
</div>
<div class="tab-pane fade " id="unreaded" role="tabpanel" aria-labelledby="unreaded-tab">
  <?php $MAIL->mailsList($MAIL->fetchtUnreadList(), "Messages non-lus", "Vous n'avez pas de nouveaux messages.")?>
</div>
<div class="tab-pane fade" id="readed" role="tabpanel" aria-labelledby="readed-tab">
  <?php $MAIL->mailsList($MAIL->fetchReadList(), "Messages lus", "Vous n'avez plus de messages lus.")?>
</div>
<div class="tab-pane fade" id="saved" role="tabpanel" aria-labelledby="saved-tab">
  <?php $MAIL->mailsList($MAIL->fetchSaveList(), "Messages enregistrés", "Vous n'avez pas de messages enregistrés.")?>
</div>
<div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
  <?php $MAIL->mailsList($MAIL->fetchArchiveList(), "Messages archivés", "Vous n'avez pas de messages archivés.")?>
</div>
<div class="tab-pane fade" id="trashed" role="tabpanel" aria-labelledby="trashed-tab">
  <?php $MAIL->mailsList($MAIL->fetchInactiveList(), "Message supprimés", "Votre corbeil est vide.")?>
</div>