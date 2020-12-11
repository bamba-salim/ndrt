$(function () {
  console.log('ready');
})

// view order details
function viewOrder(id) {
  $('#viewOrder' + id).modal('show');
}

// cancel order
function cancelOrder(id) {
  $('#cancelOrder' + id).modal('show');
}
function confirmeCancelOrder(id) {
  window.open("./_set?ad=order&id=" + id, "_self")
}

// edit adress
function editAdresse(id) {
  $('#editAdressModal' + id).modal('show');
}

// delete adresse
function deleteAdresse(id) {
  $('#deleteAdressModal' + id).modal('show');
}
function comfirmDeleteAdresse(id) {
  window.open("./_del?ad=adress&id=" + id, "_self")
}

// bill order
function viewBillOrder(orderRef) {
  
  window.open("./facture?ref=" + orderRef);

}
