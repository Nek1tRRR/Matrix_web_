$( function() {
    $( ".datepicker" ).datepicker({ dateFormat: "dd-mm-yy"});
} );

var showUserControll = function (){
    $("#top-controll").css({"display":"block"});
    $(document).mouseup(function (e) {
        var container = $("#top-controll");
        if (container.has(e.target).length === 0){
            container.hide();
        }
    });
}