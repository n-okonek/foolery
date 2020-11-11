function showForm(form){
  $(".".concat(form)).fadeIn();
}

function closeForm(form){
  $("#".concat(form))[0].reset();
  $(".".concat(form)).fadeOut();
}

function showEditCoupon(code,desc){
  $(".edit-coupon").fadeIn();
  $("#edit-coupon > div:nth-child(1) > input:nth-child(2)").val(code);
  $("#edit-coupon > div:nth-child(2) > input:nth-child(2)").val(desc);
}
