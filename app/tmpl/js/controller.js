var regist = function (step) {
    if (step == 1){
        var name = $("#name").val(),
            surname = $("#surname").val(),
            birthday = $("#birthday").val();
        if (name != undefined && surname != undefined && birthday != undefined){
            $.ajax({
                url: 'http://' + location.hostname + '/action?regist',
                type: 'POST',
                data: {step: 1, name: name, surname: surname, birthday:birthday},
                error: function (){

                },
                success: function (){

                }
            });
        }
    }
}