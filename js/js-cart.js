function chooseAdresse() {
  console.log('choose adresse');
  $('#chooseAdress').modal('show');
}

function getAdressFac() {
  var livraison = $('#facturation').val();
  console.log(livraison);
}

function getAdressLiv() {
  var livraison = $('#livraison').val();
  console.log(livraison);
}