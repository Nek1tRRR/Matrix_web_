var LOCATION = 'http://' + location.hostname + '/';


$( function() {
    $( ".datepicker" ).datepicker({ dateFormat: "dd-mm-yy"});
} );

var showUserControll = function (){                   //функция показа меню иконки user
    $("#top-controll").css({"display":"block"});
    $(document).mouseup(function (e) {
        var container = $("#top-controll");
        if (container.has(e.target).length === 0){
            container.hide();
        }
    });
}

$(document).mouseup(function (e) {
    var container = $(".controll-bg");
    if (container.has(e.target).length === 0) {
        container.remove()
    }
});

var showUserBannerControll = function (img){
    $('body').append(
        '<div class = "flex-center controll-bg">'+
            '<div class = "controll-block">'+
                '<div class = "title-block">Настройка баннера</div>'+
                '<div class = "img-block">'+
                    '<img src = "'+img+'" id = "banner-img">'+
                '</div>'+
                '<div class = "edit-links">'+
                    '<ul class = "links-list">'+
                        '<li id = "l-download"><label>Загрузить<input type = "file" data-url= "/upload?userBanner" multiple="multiple" accept=".txt,image/*"  id = "userBanner"></label></li>'+
                        '<li id = "l-edit" onclick = "editUserBanner()"><label>Изменить</label></li>'+
                        '<li id = "l-delete" onclick = "deleteUserBanner()"><label>Удалить</label></li>'+
                    '</ul>'+
                '</div>'+
            '</div>'+
        '</div>'
    ).change();
    if (img == '/app/tmpl/img/avatar/matrix_nofoto.jpg'){
        $("#l-edit, #l-delete").css({'display':'none'});
    }
    $("#userBanner").change(function(){
        var send_url = $(this).attr('data-url');
        var fd = new FormData();
        fd.append("userBanner", this.files[0]);
        $.ajax({
            url: send_url,
            type: "POST",
            data: fd,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (a) {
                if(a[0] == 'success'){
                    $(".controll-block .img-block").html("<img src = '"+a[1]+"' id = 'banner-img'>");
                    $(".controll-block .edit-links .links-list").html(
                        '<li id = "l-save"><label>Сохранить</label></li>'+
                        '<li id = "l-delete" onclick = "deleteUserBanner()"><label>Удалить</label></li>');
                    cropBanner(a[1]);

                }
            }
        })
    });
}

var cropBanner = function (img_src){
    var to = LOCATION + 'uploads/users/banner-croped/';
    $(".controll-block .img-block img").cropper({
        zoomable: false,
        viewMode: 1,
        aspectRatio: 2/0.6,
        autoCropArea: 1,
        minCropBoxHeight: 350,
        minCropBoxWidth: 1000,
        coords: this.crop,
        crop: function (e) {
            this.coords = {top: e.y, left: e.x, width: e.width, height: e.height};
        },
        cropend: function (){
            var top = this.coords.top,
                left = this.coords.left,
                width = this.coords.width,
                height = this.coords.height;
            $("#l-save").click(function () {
                $.ajax({
                    url: LOCATION + 'upload?bannerNew',
                    type: "POST",
                    data: {from:img_src, to: to, top: top, left: left, width:width, height: height},
                    success: function () {

                    },
                    complete: function () {
                        location.href = LOCATION;
                    }
                })
            })
        }
    });
}

var deleteUserBanner = function () {
    $.ajax({
        url: LOCATION + 'upload?deleteUserBanner',
        type: 'POST',
        success: function (){
            location.href = LOCATION;
        }
    })
}

var editUserBanner = function () {
    $.ajax({
        url: LOCATION + 'upload?userBanner',
        type: 'POST',
        success: function (img) {
            cropBanner(img);
            $(".controll-block .edit-links .links-list").html(
                '<li id = "l-save" ><label>Сохранить</label></li>'+
                '<li id = "l-delete" onclick = "deleteUserBanner()"><label>Удалить</label></li>');
        }

    })
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///работа с аватаром

var new_avatar = function (img) {
    $('body').append(
        '<div class = "flex-center controll-bg">' +
        '<div class = "controll-block">' +
        '<div class = "title-block">Добавление аватара</div>' +
        '<div class = "avatar-block">' +
        '<img src = "' + img + '">' +
        '</div>' +
        '<div class = "edit-links">' +
        '<ul class = "links-list">' +
        '<li id = "l-download"><label>Выбрать<input type = "file" data-url= "upload?newUserAvatar" multiple="multiple" accept=".txt,image/*"  id = "userAvatar"></label></li>' +
        '</div>' +
        '</div>' +
        '</div>'
    );

    $("#send_url").change(function () {
        var send_url = $(this).attr('data-url');
        var fd = new FormData();
        $.ajax({
            url: LOCATION + send_url,
            type: 'POST',
            data: fd,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (a) {
                $(".controll-bg .avatar-block").html("<img src = '" + a[1] + "'>");
                $(".controll-block .edit-links .links-list").
                html(
                    '<li id = "l-save"><label>Сохранить</label></li>' +
                    '<li id = "l-delete" onclick = "delUserAvatar()"><label>Удалить</label></li>'
                );
                cropAvatar(a[1]);

            }
        })
    })
}

var cropAvatar = function (img) {
    $(".controll-bg .avatar-block img").cropper({
        zoomable: false,
        viewMode: 1,
        aspectRatio: 1 / 1,
        autoCropArea: 1,
        minCropBoxHeight: 100,
        minCropBoxWidth: 100,
        coords: this.crop,
        crop: function (e) {
            this.coords = {top: e.y, left: e.x, width: e.width, height: e.height};
        },
        cropend: function () {
            var top = this.coords.top,
                left = this.coords.left,
                width = this.coords.width,
                height = this.coords.height;
            $("#l-save").click(function () {
                $.ajax({
                    url: LOCATION + 'upload?editUserAvatar',
                    type: "POST",
                    data: {from: img, top: top, left: left, width: width, height: height},
                    success: function (a) {
                        location.href = LOCATION;
                    }
                })
            })
        }
    });
}

var delUserAvatar = function () {
    $.ajax({
        url: LOCATION + 'upload?deleteUserAvatar',
        type: "POST",
        success: function () {
            location.href = LOCATION;
        }
    })
}

var edit_avatar = function (img){
    $('body').append(
        '<div class = "flex-center controll-bg">' +
        '<div class = "controll-block">' +
        '<div class = "title-block">Изменение аватара</div>' +
        '<div class = "avatar-block">' +
        '<img src = "' + img + '">' +
        '</div>' +
        '<div class = "edit-links">' +
        '<ul class = "links-list">' +
        '<li id = "l-save"><label>Сохранить</label></li>' +
        '<li id = "l-delete" onclick = "delUserAvatar()"><label>Удалить</label></li>'+
        '</ul>' +
        '</div>' +
        '</div>' +
        '</div>'
    );
    cropAvatar(img);

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///работа с блоком добавления новостей

var  post = {

    createBlock: function(){
        if($('.hidden-block').html() == undefined) {

            $('.fast-creator-block').hide();

            var img_block = "<div class = 'fast-creator-block hidden-block flex-middle'>\n"+
                "<img src = '/app/tmpl/img/menu/camera.png' title = 'Добавить фото'>\n"+
                "<img src = '/app/tmpl/img/menu/video-camera.png' title = 'Добавить видео'>\n"+
                "<img src = '/app/tmpl/img/menu/music.png' title = 'Добавить аудиозапись'>\n"+
                "<img src = '/app/tmpl/img/menu/document.png' title = 'Добавить документ'>\n"+
                '</div>'+
                "<div class = 'submit-block'><input type = 'submit' class = 'submit' value = 'Отправить' onclick = 'post.create()'></div>";


            var container = '<div class = "flex-between flex-middle bottom-controll">'+img_block+'</div>'

            $('.input-post-block').append(container);
        }
    },
    create: function (){
        var val = $('.create-new-post-block').text();
        $.ajax({
            url: LOCATION + 'upload?createPost',
            data: {text: val},
            type: 'POST',
            dataType: 'json',
            success: function (a){
                if(a[1] == 'success'){
                    $('.input-post-block').remove();
                    $('.fast-creator-block').show();
                    post.update();
                }
            }
        })
    },
    update: function (){
        this.getData()
    },
    getData: function (){
        var login = location.pathname.substr(2); //здесь было substr  вроде как надо на mb_substr поменять
        $.ajax({
            url: LOCATION + 'upload?getPosts',
            data: {code: login},
            type: 'POST',
            success: function (a){

            }
        })
    }
}




// $("#userAvatar").change(function () {
//     var send_url = $(this).attr('data-url');
//     var fd = new FormData();
//     fd.append("userBanner", this.files[0]);
//     $.ajax({
//         url: LOCATION + send_url,
//         type: 'POST',
//         data: fd,
//         dataType: 'json',
//         processData: false,
//         contentType: false,
//         success: function (a) {
//             $(".controll-bg .avatar-block").html("<img src = '" + a[1]+"'>");
//             $(".controll-block .edit-links .links-list").
//             html(
//                 '<li id = "l-save"><label>Сохранить</label></li>' +
//                 '<li id = "l-delete" onclick = "delUserAvatar()"><label>Удалить</label></li>'
//             );
//             cropAvatar(a[1]);
//
//         }
//     })
// })

//         $(".controll-bg .avatar-block img").cropper({
//             zoomable: false,
//             viewMode: 1,
//             aspectRatio: 1/1,
//             autoCropArea: 1,
//             minCropBoxHeight: 100,
//             minCropBoxWidth: 100,
//             coords: this.crop,
//             crop: function (e) {
//                 this.coords = {top: e.y, left: e.x, width: e.width, height: e.height};
//             },
//             cropend: function () {
//                 var top = this.coords.top,
//                     left = this.coords.left,
//                     width = this.coords.width,
//                     height = this.coords.height;
//                 $("#l-save").click(function () {
//                     $.ajax({
//                         url: LOCATION + 'upload?editUserAvatar',
//                         type: "POST",
//                         data: {from: img, top: top, left: left, width: width, height: height},
//                         success: function () {
//
//                         }
//                     })
//                 })
//             }
//         });
//     }else{
//         $("#userAvatar").change(function (){
//             var send_url = $(this).attr('data-url');
//             var fd = new FormData();
//             fd.append("userBanner", this.files[0]);
//             $.ajax({
//                 url: LOCATION + send_url,
//                 type: 'POST',
//                 data: fd,
//                 dataType: 'json',
//                 processData: false,
//                 contentType: false,
//                 success: function (a){
//                     if(a[0] == 'success'){
//                         $(".controll-block .avatar-block").html("<img src = '"+a[1]+"' id = 'banner-img'>");
//                         $(".controll-block .edit-links .links-list").html(
//                         html
//                         (
//                             '<li id = "l-delete"><label>Удалить</label></li>'
//                         );
//                     }
//                 }
//             })
//         })
//     }
// }