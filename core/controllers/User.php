<?php

class User
{
    protected $db, $config;
    public $id, $sess_id, $login, $password, $email, $name, $surname, $birthday, $status, $city, $big_avatar, $avatar, $friends;
    public function __construct($login = '')
    {
        $this -> connect();
        $this -> id($login);
        $this -> login();
        $this -> password();
        $this -> email();
        $this -> name();
        $this -> surname();
        $this -> birthday();
        $this -> status();
        $this -> city();
        $this -> big_avatar();
        $this -> avatar();
        $this -> sess_id();
        $this -> friends();
    }

    protected function connect()
    {
        include_once "core/controllers/DB.php";
        $this -> config = include 'core/config/default.php';
        $this -> db = new DB($this -> config['DB']['name'], $this -> config['DB']['user'], $this -> config['DB']['pass'], $this -> config['DB']['host'], $this -> config['DB']['type']);

    }

    protected function sess_id()
    {
        $query = $this -> db -> getRow("SELECT `id` FROM `users` WHERE `id` = ?", [$_SESSION['user']['id']]);
        if(!empty($query['id']))
        {
            $this -> sess_id = $_SESSION['user']['id'];
        }

    }

    protected function id($login = '')
    {
        if(empty($login)){
            if(!empty($_SESSION['user']['id']))
            {
                if($_SESSION['page']['class'] == 'profile')
                {
                    $query = $this -> db -> getRow("SELECT `id` FROM `users` WHERE `login` = ?", [$_SESSION['page']['params']]);
                    return $this -> id = $query['id'];
                }else{
                    return $this -> id = $_SESSION['user']['id'];
                }
            }
        }else{
            $query = $this -> db -> getRow("SELECT `id` FROM `users` WHERE `login` = ?", [$login]);
            return $this -> id = $query['id'];
        }
    }

    protected function login()
    {
        $query = $this -> db -> getRow("SELECT `login` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> login = $query['login'];
    }
    protected function password()
    {
        $query = $this -> db -> getRow("SELECT `password` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> password = $query['password'];
    }

    protected function email()
    {
        $query = $this -> db -> getRow("SELECT `email` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> email = $query['email'];
    }

    protected function name()
    {
        $query = $this -> db -> getRow("SELECT `name` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> name = $query['name'];
    }

    protected function surname()
    {
        $query = $this -> db -> getRow("SELECT `surname` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> surname = $query['surname'];
    }

    protected function birthday()
    {
        $query = $this -> db -> getRow("SELECT `birthday` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> birthday = $query['birthday'];
    }

    protected function status()
    {
        $query = $this -> db -> getRow("SELECT `status` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> status = $query['status'];
    }

    protected function city()
    {
        $query = $this -> db -> getRow("SELECT `city` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> city = $query['city'];
    }

    public function big_avatar()
    {
        $query = $this -> db -> getRow("SELECT `big_avatar` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> big_avatar = $query['big_avatar'];
    }

    public function bannerSRC()
    {
        $query = $this -> db -> getRow("SELECT `bannerSRC` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $query['bannerSRC'];
    }

    public function avatar()
    {
        $query = $this -> db -> getRow("SELECT `avatar` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $this -> avatar = $query['avatar'];
    }

    public function avatarSRC()
    {
        $query = $this -> db -> getRow("SELECT `avatarSRC` FROM `users` WHERE `id` = ?", [$this -> id]);
        return $query['avatarSRC'];
    }

    protected function friends()
    {
        $query = $this -> db -> getRows("SELECT `id_friend` FROM `friends` WHERE `id_user` = ? & `status` = 1", [$this -> id]);
        $count = $this -> db -> getRow("SELECT count(`id_friend`) FROM `friends` WHERE `id_user` = ? & `status` = 1", [$this -> id]);
        if($count['count(`id_friends`)'] != 0)
        {
            for($i = 0; $i < $count; $i++)
            {
                $friend[] = $query[$i]['id_friend'];
            }
            return $this -> friends = $friend;
        }else{
            return 0;
        }
    }
}