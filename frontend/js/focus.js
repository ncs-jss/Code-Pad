$(".form.row .form-group input, .form.row .form-group textarea").focus(function() {

    $("label[for='" + this.id + "']").addClass("labelfocus");

    $("input, textarea").focusout( function() {

        $("label").removeClass("labelfocus");

    });

});
