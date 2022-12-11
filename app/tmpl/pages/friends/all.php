<div class = 'container page' id = 'friends-page'>
    <div class = 'center-block'>
        <div class = 'flex-between'>
            <?php $this -> module('left-nav')?>
            <div class = 'middle-main-block'>
                <div class = 'top-block'>
                    <div class = 'flex-middle flex-between'>
                        <ul class = 'top-link-list flex-middle'>
                            <li>Все друзья</li>
                            <li>Друзья онлайн</li>
                        </ul>
                        <input type= 'submit' class = 'submit' value = 'Найти друзей' onclick = 'location.href = LOCATION + "friends?act=find"'>
                    </div>
                </div>
                <div class = 'friends-list-block'>
                    <?php
                    if($this -> user -> friends == 0){
                    ?>
                    <div class = 'flex-center empty-friends-block'>
                        <div>
                            <img src = '<?=$this -> config['SITE']['url']?>/app/tmpl/img/matrix-png/pngegg.png'>
                            <p>На данный момент здесь ничего нет....</p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class = 'white-block' id = 'right-nav'>

            </div>
        </div>
    </div>
</div>