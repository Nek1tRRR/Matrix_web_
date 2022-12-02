<div class = 'module' id = 'top-container'>
    <div class = 'flex-middle flex-between center-block'>
        <div class = 'logo' id = 'logo-box'>
            <a href = '<?=$this -> config['SITE']['url']?>' class = 'link-to-start'>
                MATRIX
            </a>
        </div>
        <div class = 'search-block'>
            <input type = 'search' id = 'search'placeholder = 'Поиск...' required>
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
                        <span>Neo</span>
                        <img src = '/app/tmpl/img/menu/Userneo.png'>
                    </div>
                    <ul id = 'top-controll'>
                        <li> <a href = ''>Моя страница </a> </li>
                        <li> <a href = ''>Настройки </a> </li>
                        <li> <a href = ''>Редактировать </a> </li>
                        <li> <a href = '/action?exit'>Покинуть матрицу </a> </li>
                    </ul>
                </li>
            </ul>
        <?php
            }
        ?>
    </div>
</div>
<!--        <div class = "middle-container">-->
<!--        <div class = "logotype">-->
<!--            <a class = "a-block" href = "--><?//=$this -> config['SITE_URL']?><!--start"></a>-->
<!--        </div>-->
<!--        <nav class = "horizontal">-->
<!--            <ul>-->
<!--                <li>-->
<!--                    <a href = "">Курсы</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href = "">Статьи</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href = "">Видео</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href = "">Тестирование</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </nav>-->
<!--        <div class = "search">-->
<!--            <form action = "javascript:void(null)" id = "top-search-form" method = "post" onsubmit = "search()">-->
<!--                <input type = "search" name = "search" class = "input-search" placeholder = "Поиск по --><?//=$this -> config['SITE_NAME']?><!--...">-->
<!--            </form>-->
<!--        </div>-->
<!--        <div id = "top-links-auth">-->
<!--            --><?php
//            if( empty( $this -> user -> id ) ){
//                ?>
<!--                <a href = "/sign_in">Войти</a>-->
<!--                или-->
<!--                <a href = "/sign_up">Регистрация</a>-->
<!--                --><?php
//            } else {
//                ?>
<!--                <a href = "/exit">Выйти</a>-->
<!--                --><?php
//            }
//            ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<div id = "under"></div>-->