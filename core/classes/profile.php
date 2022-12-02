<?php

class profile extends Main
{
    public function _main_()
    {
        if(!empty($this -> user -> id))
        {
            $this -> header ();
            $this -> module ('top-container');
            $this -> page( 'userPage');
            $this -> footer();
        }else{
            $_SESSION['info'] = 'Чтобы увидеть страницу "ИЗБРАННОГО" необходимо авторизоваться!';
            header("Location: /auth?sign_in");
        }
    }
}