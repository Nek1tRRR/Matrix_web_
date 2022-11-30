var registration = function (step){
    if (step == '1'){
        var name = $("#name").val(),
            surname = $("#surname").val(),
            birthday = $("#birthday").val();

            $.ajax({
                url: 'http://' + location.hostname + '/action?registration',
                type: 'POST',
                data: {step: 1, name: name, surname: surname, birthday: birthday},
                error: function (){

                },
                success: function (res){
                    if (res == 'ok') {
                        location.href = 'http://' + location.hostname + '/auth?registration=step1';
                    }
                }
            });
    }
    else if(step == '2') {
        var email = $("#email").val();
        $.ajax({
            url: 'http://' + location.hostname + '/action?registration',
            type: 'POST',
            data: {step: 2, email: email},
            error: function (){

            },
            success: function (res){
                if (res == 'ok') {
                    location.href = 'http://' + location.hostname + '/auth?registration=step2';
                }
                else if(res == 'not empty'){
                    alert('Такой пользователь уже зарегистрирован')
                }
            }
        });
    }
    else if (step == '3'){
        var pin = $("#pin").val();
        $.ajax({
            url: 'http://' + location.hostname + '/action?successPin',
            type: 'POST',
            data: {pin: pin},
            error: function () {

            },
            success: function (res) {
                if (res == 'ok') {
                    location.href = 'http://' + location.hostname + '/auth?registration=step3';
                }
            }
        })
    }
    else if(step == 'finish') {
        var password = $("#password").val(),
            r_password = $("#r-password").val();

        if(password == r_password){
            $.ajax({
                url: 'http://' + location.hostname + '/action?registration',
                type: 'POST',
                data: {step: 'finish', password: password},
                error: function () {

                },
                success: function (res) {
                    location.href = 'http://' + location.hostname + '/@' + res;
                }
            })
        }
    }
}