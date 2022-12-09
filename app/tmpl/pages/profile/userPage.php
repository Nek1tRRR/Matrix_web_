<div class = 'container page' id = 'user-page'>
    <div class = 'center-block'>
        <div class = 'profile-header'>
            <div class = 'user-avatar-container' style = 'background-image:url(<?=$this -> user -> big_avatar();?>);'>
                <div class = 'grey' <?php if($this -> config['PAGE']['params'] == $this -> user -> login) {?>style = 'cursor:pointer;'<?php }?>>
                    <?php if($this -> config['PAGE']['params'] == $this -> user -> login) {?><img class = 'download-big-avatar' onclick="showUserBannerControll('<?=$this -> user -> bannerSRC()?>')" src = '/app/tmpl/img/menu/download.png'><?php }?>
                    <div class = 'user-name'><?=$this -> user -> name . " " . $this -> user -> surname?></div>
                </div>
            </div>
            <div class = ' main-user-menu-container'>
                <div class = 'user-main-avatar'>
                    <img src = '<?=$this -> user -> avatar();?>'>
                    <ul class = 'controll-avatar-block'>
                        <li onclick = 'del_avatar()'>Удалить аватар</li>
                        <li onclick = 'edit_avatar()'>Изменить миниатюру</li>
                        <li onclick = 'new_avatar("<?=$this -> user -> avatar()?>")'>Установить новую</li>
                    </ul>
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
        <div class = 'flex-between middle-main-container'>
            <div class = 'left-container'>
            <?php
            if($this -> user -> status == 'admin' and $this -> user -> login == $this -> config['PAGE']['params']){
            ?>
                <div class = 'white-block left-nav'>
                    <a href = ' '>Админ-панель</a>
                </div>
            <?php
            }
            ?>
            </div>
            <div class = 'right-container'>
                <div class = 'white-block' id = 'user-info-block'>
                    <div class = 'main-info'>
                        <div class = 'flex-middle info-tr'>
                            <div class = 'info-row'>День рождения:</div>
                            <div class = 'lbl-row'><?=$this -> user -> birthday?></div>
                        </div>
                        <div class = 'flex-middle info-tr'>
                            <div class = 'info-row'>Email</div>
                            <div class = 'lbl-row'><?=$this -> user -> email?></div>
                        </div>
                        <div class = 'flex-middle info-tr'>
                            <div class = 'info-row'>Город</div>
                            <div class = 'lbl-row'><?=$this -> user -> city?></div>
                        </div>
                    </div>
                    <div class = 'flex-middle flex-between list-dop-info'>
                        <div class = 'lbl'>
                            <div class = 'count'>0</div>
                            <div class = 'inf'>Друзей</div>
                        </div>
                        <div class = 'lbl'>
                            <div class = 'count'>0</div>
                            <div class = 'inf'>Подписчиков</div>
                        </div>
                        <div class = 'lbl'>
                            <div class = 'count'>0</div>
                            <div class = 'inf'>Снимков</div>
                        </div>
                        <div class = 'lbl'>
                            <div class = 'count'>0</div>
                            <div class = 'inf'>Видео</div>
                        </div>
                        <div class = 'lbl'>
                            <div class = 'count'>0</div>
                            <div class = 'inf'>Аудио</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>