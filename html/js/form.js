function send(form) {
  //Change the background of the fields from red to green if they are valid
  document.addEventListener("DOMContentLoaded", function() {
    document.forms[0].addEventListener('submit', function(e) {
      e.preventDefault();
      e.currentTarget.classList.add('submitted');
    });
  });

  var alertMessage = '';

  if (form == 'login' || form == 'register') {
    // Email validation for login and register
    // Validate all the fields
    var emailType = 'email-field';
    var name = document.getElementById('name-field').value;
    var date = document.getElementById('date-field').value;
    if (form == 'login') {
      emailType += '-l';
    } else {
      emailType += '-r';
      alertMessage += validateDate(date);
      //   alertMessage = alertMessage + validateName(name);
    }
    var email = document.getElementById(emailType).value;

    alertMessage += validateEmail(email);
  } else if (form == 'newPhone') {
    // Validate new Review form
  } else if (form == 'update-account') {
    // Validate account update form
  } else if (form == 'search') {
    // Validate account search form
  } else if (form == 'new-review') {
    // Validate sumbit new review
    var comment = document.getElementById('comments').value;
    alertMessage += validateComment(comment);
  }
  //Check if there is an alertMessage
  if (alertMessage == '') {
    var submitForm = document.getElementById(form + "form");
    if (submitForm != null) {
      submitForm.submit();
    }
  } else {
    //Print out alert message
    alert(alertMessage);
  }
}

function validateComment(comment) {
  var len = comment.length;
  var minchar = 50;
  var alertMessage = '';
  if(len <= minchar){
    alertMessage += 'Please enter enough characters in the review message.\n';
  }
  return alertMessage;
}

function validateEmail(email) {
  //**Variables**//
  //Email requirements
  var emailRequirements = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var alertMessage = '';

  //Check if it is a valid email
  if (email == '' || !emailRequirements.test(email)) {
    alertMessage += 'Please enter a valid email address.\n';
  }

  return alertMessage;
}

function validateDate(date) {
  //**Variables**//
  //Date requirements
  var dateRequirements = /^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/
  var alertMessage = '';

  //Check if it is a valid date
  if (date == '' || !dateRequirements.test(date)) {
    alertMessage += 'Please enter a valid date of birth.\n';
  }

  return alertMessage;
}

function validateName(name) {
  //**Variables**//
  var alertMessage = '';

  //Check if it is a valid name
  if (name == '' || name == null) {
    alertMessage += 'Please enter a name.\n';
  }

  return alertMessage;
}

// Using Ajax to check if the user has enough characters in the review textarea
$(document).ready(function() {
  var len = 0;
  var minchar = 200;

  $('#comments').keyup(function() {
    len = this.value.length
    if (len > 0) {
      $("#minWordCount").html("Minimum characters: " + (minchar - len));
    } else {
      $("#minWordCount").html("Minimum characters: " + (maxchar));
    }
  })
});
