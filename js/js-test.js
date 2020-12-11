

function test() {
  console.log('click')
  $('#test-form').validate({
    rules: {
      mail: {
        required: true,
        mail: true
      },
      password :{
        required: true,
        nowhitespace: true
      },
      password2: {
        required: true,
        equalTo: "#password"
      },
      phone: {
        required: true,
        phoneNumber: true
      },
      client: {
        text: true
      }
    },
    messages: {
      mail: false, 
      password: {
        required: "Veuillez entrez un mot de passe"
      },
      password2: {
        required: "veuillez comfirmez votre mot de passe",
        equalTo: "les mots de passes ne correspondent pas"
      }
    }
  })
  console.log('another one')
}