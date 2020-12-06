$(document).ready(function(){
  $('#password, #password2').keyup(checkPwMatch);
  $('#card-number').blur(ccValidation);
  $('#exp').change(expValidation);
});

var validVisa = /^4[0-9]{12}(?:[0-9]{3})?$/;
var validMaster = /^5[0-9]{12}(?:[0-9]{3})?$/;
var validAmex = /^(?:3[47][0-9]{13})$/;
var validDisc = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;
var validExp = /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/;
var cardIs = ccValidation();

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

function ccValidation(){
  var ccNum = $('#card-number').val();

  var isVisa = validVisa.test(ccNum) === true;
  var isMaster = validMaster.test(ccNum) === true;
  var isAmex = validAmex.test(ccNum) === true;
  var isDisc = validDisc.test(ccNum) === true;

  if (isVisa || isMaster || isAmex || isDisc){
    if(isVisa){
      $('#cc-not-valid').hide();
      return "visa";
    }
    else if (isMaster){
      $('#cc-not-valid').hide();
      return "master";
    }
    else if (isAmex){
      $('#cc-not-valid').hide();
      return "amex";
    }
    else if (isDisc){
      $('#cc-not-valid').hide();
      return "disc";
    }
  }
  else{
    $('#cc-not-valid').show();
  }
}

function expValidation(){
  var exp = $('#exp').val();
  var month = exp.substring(0,2)-1;
  var year = exp.substring(3,7);
  var date = new Date();
  var currentMonth = date.getMonth();
  var currentYear = date.getFullYear();
  var expIsValid = validExp.test(exp) === true

  if (expIsValid){
    if (month >= currentMonth && year >= currentYear){
      $('#exp-not-valid').hide();

    }else{
      $('#exp-not-valid').show();
      $('.malformed-exp').hide();
    }
  }else{
    $('#exp-not-valid').show();
  }
}