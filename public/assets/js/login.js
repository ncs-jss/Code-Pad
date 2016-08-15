var height = $(window).height();
var objectHeight = $(".login").height();
var head = $("header").height();

var marginTop = ( height - objectHeight )/2;
marginTop=marginTop + head;
 $(".login").css({'margin-top': marginTop});
 // $(".login").css({'margin-bottom': marginTop});


 // console.log(height);
 // console.log(objectHeight);
 // console.log(head);
 // console.log(marginTop);
