// avoid whitespace
$.validator.addMethod( "whitespace", function( value, element ) {
	return this.optional( element ) || /^\S+$/i.test( value );
}, "Les éspaces ne sont pas autorisés" );

// phone number
$.validator.addMethod( "phoneNumber", function( value, element ) {
	return this.optional( element ) || /^[+0-9]{8,20}$/i.test( value );
}, "Téléphone incorect" );

// text
$.validator.addMethod( "text", function( value, element ) {
	return this.optional( element ) || /[a-zA-Z0-9\'\/\s ²~"#|()-`\^@+=,?;.:!°*€¨%$£µ]{1,}$/i.test( value );
}, "Format incorect" );

// zip code
$.validator.addMethod( "zipCode", function( value, element ) {
	return this.optional( element ) || /^[0-9]{4,5}$/i.test( value );
}, "Code postale incorect" );

// password
$.validator.addMethod( "strongPassword", function( value, element ) {
	return this.optional( element ) || /^([a-zA-Z]{1,}|[0-9]{1,}){6,}$/i.test( value );
}, "6 carractères minimum" );

// only number
$.validator.addMethod( "number", function( value, element ) {
	return this.optional( element ) || /^[a-zA-Z\d]+$/i.test( value );
}, "Format incorect" );

// word & number
$.validator.addMethod( "wordNumber", function( value, element ) {
	return this.optional( element ) || /[a-zA-Z0-9\'-.\s]{1,}$/i.test( value );
}, "Format incorect" );

// adresse mail
$.validator.addMethod( "mail", function( value, element ) {
	return this.optional( element ) || /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/i.test( value );
}, "Adresse mail incorecte" );

// words
$.validator.addMethod( "mail", function( value, element ) {
	return this.optional( element ) || /[a-zA-Z\'-.\s]{1,}$/i.test( value );
}, "Format incorecte" );

// highlight

$.validator.setDefaults({
  higlight: function (element) {
    $(element)
      .closet('ndrtInput')
      .addClass('border-red');
  },
  unhiglight: function (element) {
    $(element)
      .closet('ndrtInput')
      .removeClass('border-red');
  }
})