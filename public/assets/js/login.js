var height = $(window).height();
var objectHeight = $(".login").height();

var marginTop = ( height - objectHeight ) / 2;
 $(".login").css({'margin-top': marginTop});
