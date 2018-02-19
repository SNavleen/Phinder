function send(form) {
  document.addEventListener("DOMContentLoaded", function() {
    document.forms[0].addEventListener('submit', function(e) {
      e.preventDefault();
      e.currentTarget.classList.add('submitted');
    });
  });
  var emailType = 'email-field';
  var name = document.getElementById('name-field').value;

  if (form == 'login') {
    emailType += '-l';
  } else {
    emailType += '-r';
    //   alertMessage = alertMessage + validateName(name);
  }
  var email = document.getElementById(emailType).value;
  var alertMessage = '';

  alertMessage = validateEmail(email);

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

function validateName(name) {
  //**Variables**//
  var alertMessage = '';

  //Check if it is a valid name
  if (name == '' || name == null) {
    alertMessage += 'Please enter a name.\n';
  }

  return alertMessage;
}