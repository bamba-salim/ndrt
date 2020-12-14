$(function () {
  console.log("ready");
  $( "#dialog" ).dialog();
});

function addButton() {
	console.log("send mail");
	//href='./admin?ad=<?= $_GET['ad'] ?>&action=add'
}


///// VIEW MODAL /////
function viewMail(ref) {
  window.open('./src/module/single_mail_module?ref='+ref,'height=200,width=150')
	// _open_modal_set_update(id, "view", function (id) {
	// 	readMail(id);
	// });
}




///// SAVE | UNSAVE /////
function saveMail(id) {
  comfirmUpdate(id, "save");
  _reload();
}
function unsaveMail(id) {
	comfirmUpdate(id, "unsave");
	_reload();
}

///// READ | UNREAD /////
function readMail(id) {
	comfirmUpdate(id, "read");
}
function unreadMail(id) {
	comfirmUpdate(id, "unread");
	_reload();
}

///// ARCHIVE | UNARCHIVE /////
function archiveMail(id) {
  comfirmUpdate(id, "archive");
  _reload();
}
function unarchiveMail(id) {
	comfirmUpdate(id, "unarchive");
	_reload();
}

///// ACTIVE | INACTIVE /////
function activeMail(id) {
	comfirmUpdate(id, "active");
	_reload();
}
function inactiveMail(id) {
  comfirmUpdate(id, "inactive");
  _reload();
}


// delete
function deleteMail(id) {
	_open_modal_set_update(id, "delete");
}

// delete all
function deleteAllMail(id) {
	_open_modal_set_update(id, "deleteAll");
}



// COMMUN FUNCTION

//OPEN MODAL
function _open_modal_set_update(id, update) {
	$("#" + update + "-modal-" + id).modal("show");
	console.log("#" + update + "-modal-" + id);
}

function comfirmUpdate(id, update = "") {
	console.log(update + " " + id);

	window.open("./_set?ad=mail&action=" + update + "&id=" + id, "_self");
	
  // $.ajax({
  //   url: "./_set",
  //   method: "GET",
  //   data: { ad: "mail", action: update, id: id },
  //   dataTypes: "text",
  //   success: function () {
  //     console.log("succes")

  //   }
  // })

}

function _reload() {
  // $('#mails-tabContent').load('./')
  // $('#mails-tabContent').load('./src/module/mail_section_module.php')
	console.log("reload");
	// location.reload(true);
}
