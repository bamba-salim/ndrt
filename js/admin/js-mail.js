$(function () {
  console.log("ready");


});

function addButton() {
  console.log("send mail");
  //href='./admin?ad=<?= $_GET['ad'] ?>&action=add'
}

function viewMail(id) {
  $('#viewMailModal' + id).modal('show', function () {
    readMail(id)
  })

}

// read
function readMail(id) {
  comfirmUpdate(id, "read");
}



// unread
function unreadMail(id) {
  comfirmUpdate(id, "unread");
}


// delete from save
function unsaveMail(id) {
  _open_modal_set_update(id, "unsave", "Supprimez " + id + " des sauvegardes", "Comfirmez vous l'archivage de ce messgae (id: " + id + ") ?", "archive")
}

// send to saved
function saveMail(id) {
  _open_modal_set_update(id, "save", "Sauvegarder " + id, "Sauvegardez " + id, "Comfirmez vous la sauvegarde ce message ?")
}

//mail
function archiveMail(id) {
  _open_modal_set_update(id, "archive", "Comfirmez vous l'archivage de ce messgae ?")
}



// send to trashed
function inactiveMail(id) {
  _open_modal_set_update(id, "inactive", "Comfirmez vous l'archivage de ce messgae ?")
}


// delete from archive
function unarchiveMail(id) {
  comfirmUpdate(id, "unarchive")
}

// delete from save
function unsaveMail(id) {
  comfirmUpdate(id, "unsave")
}

// delete from trashed
function activeMail(id) {
  comfirmUpdate(id, "active")
}


function comfirmUpdate(id, update = "") {
  if (update == "") var update = $("#updateVal" + id).val();

  console.log(update + " " + id);
  $.ajax({
    url: "./_set",
    method: "GET",
    data: { ad: "mail", action: update, id: id },
    dataTypes: "text",
    success: function () {
      console.log("succes")
      $('#updateModal' + id).modal('hide');
      location.reload(true)
      
    }
  })

}

function _open_modal_set_update(id, update, title, message = "") {
  $('#updateModal' + id).modal('show');
  $('#titleModal' + id).text(title);
  $("#textUpdate" + id).text(message);
  $("#updateVal" + id).val(update);


}