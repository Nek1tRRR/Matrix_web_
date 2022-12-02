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
            $query = $this -> db ->getRow("SELECT `id` FROM `users` WHERE `email` = ? or `login`", [$_SESSION['user']['sess_email'], $_POST['login']]);
            if(empty($query['id']))
            {
                $_SESSION['user']['sess_password'] = md5( $_POST['password'] . $_POST['login']);
                $query = $this -> db -> insertRow("INSERT INTO `users` (`login`, `email`, `password`, `name`, `surname`, `birthday`) VALUES (?,?,?,?,?,?)", [$_POST['login'], $_SESSION['user']['sess_email'], $_SESSION['user']['sess_password'],$_SESSION['user']['sess_name'],$_SESSION['user']['sess_surname'],$_SESSION['user']['sess_birthday']]);
                if($query) {
                    $query = $this->db->getRow("SELECT `id` FROM `users` WHERE `login` = ? and `password` = ?", [$_POST['login'], $_SESSION['user']['sess_password']]);
                    $_SESSION['user']['id'] = $query['id'];
                    $a = strpos($_SESSION['user']['sess_email'], '@');
                    echo json_encode(['ok', $_POST['login']]);
                }
            }else{
                echo 'user exists';
            }
        }
    }

    public function _successPin_()
    {
        if($_POST['pin'] == $_SESSION['user']['sess_pin'])
        {
//            $_SESSION['user']['sess_password'] = md5($_POST['pin'] . $_SESSION['user']['email']);
            echo 'ok';
        }else{
            echo false;
        }
    }

    public function _exit_()
    {
        session_destroy();
        header( "Location: /start");
    }

    public function _auth_()
    {
        $password = md5($_POST['password'] . $_POST['login']);
        include 'core/controllers/DB.php';
        $this -> config = include 'core/config/default.php';
        $this -> db = new DB($this -> config['DB']['name'], $this -> config['DB']['user'], $this -> config['DB']['pass'], $this -> config['DB']['host'], $this -> config['DB']['type']);
        $query = $this -> db -> getRow("SELECT `id` FROM `users` WHERE `login` = ? and `password` = ?", [$_POST['login'],$password]);
        if(!empty($query['id']))
        {
            $_SESSION['user']['id'] = $query['id'];
            echo json_encode(['ok', $_POST['login']]);
        }else{
            echo 'User is not exist';
        }
    }











}