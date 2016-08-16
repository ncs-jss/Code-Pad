// Vertically center login box
var height = $(window).height();
var objectHeight = $(".login").height();


var marginTop = ( height - objectHeight ) / 2;
 $(".login, .signup").css({'margin-top': marginTop});

// Sign Up/ login Logic

$(".show-signup").on("click", function(){
  $(".signup").removeClass("hide");
  $(".login").addClass("hide");
});

$(".show-login").on("click", function(){
  $(".signup").addClass("hide");
  $(".login").removeClass("hide");
});
