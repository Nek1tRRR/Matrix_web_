<div class = 'container page' id = 'start-page'>
    <div class = 'flex-between center-block'>
        <div class = 'left-container'>
            <div class = 'welcome-text'>ДОБРО ПОЖАЛОВАТЬ НА САЙТ MATRIX_WEB!</div>
            <div class = 'big-img-friends' data-parallax="scroll" data-image-src="/app/tmpl/img/bg/matrix-png.png"></div>
        </div>
        <div class = 'right-container'>
            <div class= 'white-block form-auth'>
                <form action= 'javascript:void(null)' onsubmit = "auth()">
                    <input type = 'text' class = 'input-data' id = 'login' placeholder = 'Логин' required>
                    <input type = 'password' class = 'input-data' id = 'password' placeholder = 'Пароль' required>
                    <div class = 'sub-block flex-between flex-middle'>
                        <input type = 'submit' value = 'Войти'>
                        <a href = ''>Забыли пароль?</a>
                    </div>
                </form>
            </div>
            <div class= 'white-block form-registration'>
                <form action= 'javascript:void(null)' onsubmit = "registration(1) ">
                    <div class = 'title-block'>Регистрация</div>
                    <input type = 'text' class = 'input-data' id = 'name' placeholder = 'Имя' required>
                    <input type = 'text' class = 'input-data' id = 'surname' placeholder = 'Фамилия' required>
                    <input type = 'text' class = 'input-data datepicker' id = 'birthday' placeholder = 'Дата рождения' maxlength="10" required>
                    <select class = 'input-data' id = 'sex'>
                        <option selected>Ваш пол</option>
                        <option>Мужской</option>
                        <option>Женский</option>
                    </select>
                    <div class = 'sub-block flex-between flex-middle'>
                        <input type = 'submit' value = 'Зарегистрироваться'>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
