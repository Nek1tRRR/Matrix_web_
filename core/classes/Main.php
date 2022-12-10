<?php

abstract class Main
{
    protected $db, $config = [], $user, $post;
    public function __construct()
    {
        include "core/controllers/DB.php";
        include "core/controllers/User.php";
        include "core/controllers/Post.php";


        $this -> config = include 'core/config/default.php';


        $this -> config['PAGE'] = ['class' => $_SESSION['page']['class'], 'method' => $_SESSION['page']['method'], 'params' => $_SESSION['page']['params']];

        $this -> db = new DB($this -> config['DB']['name'], $this -> config['DB']['user'], $this -> config['DB']['pass'], $this -> config['DB']['host'], $this -> config['DB']['type']);

        $this -> user = new User();
        $this -> post = new Post($this -> user -> id);
        

    }
    protected function header()
    {
        if(file_exists('app/tmpl/includes/header.php'))
        {
            include_once 'app/tmpl/includes/header.php';
        }
    }
    protected function footer()
    {
        if(file_exists('app/tmpl/includes/footer.php'))
        {
            include_once 'app/tmpl/includes/footer.php';
        }
    }

    public function titlePage()
    {
        if($this -> config['PAGE']['class'] == 'profile' and $this -> config['PAGE']['method'] == 'main')
        {
            return $this -> user -> name . " " . $this -> user -> surname;
        }
        $query = $this -> db -> getRow( "SELECT `title` FROM `title_page` WHERE `class` = ? and `method` = ? and `params` = ?", [$this -> config['PAGE']['class'], $this -> config['PAGE']['method'], $this -> config['PAGE']['params']]);
        return $query['title'];
    }

    public function module($mod)
    {
        if(file_exists('app/tmpl/modules/' . $mod . '.php'))
        {
            include 'app/tmpl/modules/' . $mod . '.php';
        }
    }


    protected function page ($page)
    {
        if(file_exists('app/tmpl/pages/' . $this -> config['PAGE']['class'] . '/' . $page . '.php'))
        {
            include 'app/tmpl/pages/' . $this -> config['PAGE']['class'] . '/' . $page . '.php';
        }
    }

    public function sess_info_destroy()
    {
        if (!empty($_SESSION['info']))
            unset($_SESSION['info']);
    }

}