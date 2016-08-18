
$("#code").blur(function() {
    var q=$("#code").val();
    // console.log(q);
    $("#codecheck").removeClass('has-error');
    $("#codecheck span").remove();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          arr=xmlhttp.responseText;
          console.log(arr);
          if(arr!='false')
          {
            var txt=$("<strong></strong>").text("The code has already been taken.");
            var tx=$("<span></span>").append(txt);
            tx.addClass('help-block');
            $("#code").after(tx);
            $("#codecheck").addClass('has-error');

          }
        }
    };
    if(q!='')
    {
      var link="check";
      link=link+"/"+q
      // console.log(link);
      xmlhttp.open("GET", link, true);
      xmlhttp.send();
    }

});
