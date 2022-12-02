<div class = 'container page' id = 'sign_in-page'>
    <div class = 'flex-middle center-block'>
        <form class = 'form-authorization' action = 'javascript:void(null)' onsubmit = "auth()">
            <div class = 'white-block'>
                <div class = 'title-block'>Авторизация</div>
                <?php
                if(!empty($_SESSION['info'])){
                ?>
                <div class = 'info-text'><?=$_SESSION['info']?></div>
                <?php
                $this -> sess_info_destroy();
                }
                ?>
                <div class = 'data-block'>
                    <input type = 'text' class = 'input-data' id = 'login' placeholder = 'Логин' required>
                    <input type = 'password' class = 'input-data' id = 'password' placeholder = 'Пароль' required>
                </div>
                <div class = 'sub-block flex-middle'>
                    <input type = 'submit' value = 'Вход в матрицу'>
                </div>
            </div>
        </form>
    </div>
</div>