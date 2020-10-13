function showForm(form){
  $(".".concat(form)).fadeIn();
}

function closeForm(form){
  $("#".concat(form))[0].reset();
  $(".".concat(form)).fadeOut();
}