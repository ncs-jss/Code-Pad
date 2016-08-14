
$("#code").blur(function() {
    var q=$("#code").val();
    // console.log(q);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          arr=xmlhttp.responseText;
          // console.log(arr);
          if(arr!='false')
          {
            $("#code_check span").remove();
            var txt=$("<strong></strong>").text("The code has already been taken.");
            var tx=$("<span></span>").append(txt);
            tx.addClass('help-block');
            $("#code").after(tx);
            $("#codecheck").addClass('has-error');

          }
          else
          {
            $("#codecheck").removeClass('has-error');
            $("#code_check span").remove();
          }
        }
    };
    var link="check";
    link=link+"/"+q
    // console.log(link);
    xmlhttp.open("GET", link, true);
    xmlhttp.send();
});
