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
        <div id = 'eng-version'>
            <a href = ''>English version</a>
        </div>
    </div>
</div>
    <!--    <div class = "middle-container">-->
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