$(document).ready(function(){

   $("form").submit(function() {
    var name = $("#name").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var com = $("#comments").val();
    var q = { "name" : name, "email" : email, "mobile" : mobile, "comments" : com};
    q = 'q='+JSON.stringify(q);
    console.log(q);

    // $.ajax({
    //   type: "POST",
    //   url: "contactsave.php",
    //   data: result,
    //   success: function(result),
    //   dataType: dataType
    // });
    $(".output div").remove();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var arr=xmlhttp.responseText;
            console.log(arr);
            if(arr == 'Success')
            {
                var txt = $("<div></div>").text('Thank you for your message!!');
                $(".output").append(txt);
                $(".output div").addClass('alert alert-success');

            }
            else
            {
                 var txt = $("<div></div>").text('Error, Try Again!!');
                $(".output").append(txt);
                $(".output div").addClass('alert alert-danger');
            }
        }
    };
    xmlhttp.open("POST", "contactsave.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(q);

   });



    var iScrollHeight = $('#AutoScroll').prop('scrollHeight');
    var iScrollTop = $("#AutoScroll").prop("scrollTop");
    var he = $("#AutoScroll").height();
    console.log(iScrollHeight);
    console.log(iScrollTop);
    var id = setInterval(scrollBar , 2000);
    function scrollBar() {
        if(iScrollTop+he < iScrollHeight-20)
        {
            iScrollTop = $("#AutoScroll").prop("scrollTop");
            iScrollTop+=100;
            // $("#AutoScroll").prop('scrollTop',iScrollTop);
            $("#AutoScroll").animate(
                {scrollTop: iScrollTop},
                "slow",
                "linear");
        }
        else
        {
            iScrollTop-=200;
            $("#AutoScroll").animate(
                {scrollTop: "0px"},
                "fast",
                "swing");
        }
    }

});
