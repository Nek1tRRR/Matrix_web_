<div class = 'container page' id = 'user-page'>
    <div class = 'flex-between center-block'>
        <div class = 'profile-header'>
            <div class = 'user-avatar-container' style = 'background-image:url(<?=$this -> user -> big_avatar();?>);'>
                <div class = 'grey'>
                    <div class = 'user-name'><?=$this -> user -> name . " " . $this -> user -> surname?></div>
                </div>
            </div>
            <div class = ' main-user-menu-container'>
                <div class = 'user-main-avatar'>
                    <img src = '<?=$this -> user -> avatar();?>'>
                </div>
                <ul class = 'flex-between flex-middle main-menu-list'>
                    <li>
                        <a href = ''>Моя страница</a>
                    </li>
                    <li>
                        <a href = ''>Новости</a>
                    </li>
                    <li>
                        <a href = ''>Послания</a>
                    </li>
                    <li>
                        <a href = ''>Друзья</a>
                    </li>
                    <li>
                        <a href = ''>Группы</a>
                    </li>
                    <li>
                        <a href = ''>Фото</a>
                    </li>
                    <li>
                        <a href = ''>Видео</a>
                    </li>
                    <li>
                        <a href = ''>Музыка</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>