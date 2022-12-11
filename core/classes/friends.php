<?php

class friends extends Main
{
    public function _main_()
    {
        $this -> _all_();
    }

    public function _all_()
    {
        if(!empty($this -> user -> sess_id))
        {
            $this -> header ();
            $this -> module ('top-container');
            $this -> page('all');
            $this -> footer();
        }else{
            $_SESSION['info'] = 'Чтобы увидеть страницу "ИЗБРАННОГО" необходимо авторизоваться!';
            header("Location: /auth?sign_in");
        }
    }

    public function _act_($param)
    {
        if($param == 'find')
        {
            if(!empty($this -> user -> sess_id))
            {
                $this -> header ();
                $this -> module ('top-container');
                $this -> page('findFriends');
                $this -> footer();
            }else{
                $_SESSION['info'] = 'Чтобы увидеть страницу "ИЗБРАННОГО" необходимо авторизоваться!';
                header("Location: /auth?sign_in");
            }
        }
    }
}