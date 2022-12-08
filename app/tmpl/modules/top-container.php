<div class = 'module' id = 'top-container'>
    <div class = 'flex-middle flex-between center-block'>
        <div class = 'logo' id = 'logo-box'>
            <a href = '<?=$this -> config['SITE']['url']?>' class = 'link-to-start'>
                MATRIX
            </a>
        </div>
        <div class = 'search-block'>
            <input type = 'search' id = 'search' placeholder = 'Поиск...' required>
        </div>
        <?php
            if (empty($_SESSION['user']['id'])) {
        ?>
            <div id = 'eng-version'>
                <a href = ''>English version</a>
            </div>
        <?php
            }else{
        ?>
            <ul class = 'flex-middle top-list-nav'>
                <li>
                    <div class = 'flex-middle'>
                        <img src = '/app/tmpl/img/menu/pin.png' onclick = ''>
                    </div>
                </li>
                <li>
                    <div class = 'flex-middle'>
                        <img src = '/app/tmpl/img/menu/alarm.png' onclick = ''>
                    </div>
                </li>
                <li onclick = 'showUserControll()'>
                    <div class = 'flex-middle'>
                        <span><?=$this -> user -> login?></span>
                        <img src = '/app/tmpl/img/menu/Userneo.png'>
                    </div>
                    <ul id = 'top-controll'>
                        <li><a href = '/@<?=$this -> user -> login?>'>Моя страница </a></li>
                        <li><a href = ''>Настройки </a></li>
                        <li><a href = ''>Редактировать </a></li>
                        <li><a href = '/action?exit'>Покинуть матрицу </a></li>
                    </ul>
                </li>
            </ul>
        <?php
            }
        ?>
    </div>
</div>
