$(document).ready(function(){
  $('#password, #password2').keyup(checkPwMatch);
});

function validate() {
  var $valid = true;
  document.getElementById("userName").innerHTML = "";
  document.getElementById("pswd").innerHTML = "";
  
  var userName = document.getElementById("userName").value;
  var password = document.getElementById("pswd").value;
  if(userName == "") 
  {
      document.getElementById("user_info").innerHTML = "required";
    $valid = false;
  }
  if(password == "") 
  {
    document.getElementById("password_info").innerHTML = "required";
      $valid = false;
  }
  return $valid;
}

function checkPwMatch(){
  var pw = $('#password').val();
  var confirmPW = $('#password2').val();
  var passmatch;

  if ( pw != confirmPW){
    $('#passmatch').show();
    $('#passmatch').removeClass('alert-success');
    $('#passmatch').addClass('alert-danger');
    $('#passmatch').html("Passwords do not match!");
    passmatch = false;
    return passmatch;
  }else if(!pw && !confirmPW){
    $('#passmatch').hide();
  }
  else{
    $('#passmatch').show();
    $('#passmatch').removeClass('alert-danger');
    $('#passmatch').addClass('alert-success');
    $('#passmatch').html('Passwords Match')
    passmatch = true;
    return passmatch;
  }
}