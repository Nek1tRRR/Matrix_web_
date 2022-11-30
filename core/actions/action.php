<?php

class action
{
    protected $db, $config;
    public function _registration_()
    {
        include 'core/controllers/DB.php';
        $this -> config = include 'core/config/default.php';
        $this -> db = new DB($this -> config['DB']['name'], $this -> config['DB']['user'], $this -> config['DB']['pass'], $this -> config['DB']['host'], $this -> config['DB']['type']);
        if($_POST['step'] == 1)
        {
            $_SESSION['user']['sess_name'] = trim($_POST['name']);
            $_SESSION['user']['sess_surname'] = trim($_POST['surname']);
            $_SESSION['user']['sess_birthday'] = trim($_POST['birthday']);
            echo 'ok';
        }
        elseif ($_POST['step'] == 2)
        {
            $query = $this -> db ->getRow("SELECT `id` FROM `users` WHERE `email` = ?", [$_POST['email']]);
            if(empty($query['id']))
            {
                include 'core/controllers/Mail.php';
                $mail = new Mail();
                $pin = $_SESSION['user']['sess_pin'] = rand(123662, 967881);
                $body = "Для регистрации необходимо подвердить Email. Введите следующий код: {$pin}";
                if ($mail -> Send($_POST['email'], $body, 'Регистрация нового пользователя'))
                {
                    $_SESSION['user']['sess_email'] = trim($_POST['email']);
                    echo 'ok';
                }
            }else{
                echo 'not empty';
            }
        }
        elseif ($_POST['step'] == 'finish')
        {
            $query = $this -> db -> insertRow("INSERT INTO `users` (`login`, `email`, `password`, `name`, `surname`, `birthday`) VALUES (?,?,?,?,?,?)", [$_SESSION['user']['sess_email'], $_SESSION['user']['sess_email'], $_SESSION['user']['sess_password'],$_SESSION['user']['sess_name'],$_SESSION['user']['sess_surname'],$_SESSION['user']['sess_birthday']]);
            if($query)
            {
                $a = strpos($_SESSION['user']['email'], '@');
                $login = substr($_SESSION['user']['email'], 0, $a);
                echo $login;
            }
        }
    }

    public function _successPin_()
    {
        if($_POST['pin'] == $_SESSION['user']['sess_pin'])
        {
            $_SESSION['user']['sess_password'] = md5($_POST['pin'] . $_SESSION['user']['email']);
            echo 'ok';
        }else{
            echo false;
        }
    }
}