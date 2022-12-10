<?php

class Post
{
    public $id, $author, $text, $date, $views, $count;
    protected $db, $config, $user;

    public function __construct($user)
    {
        include_once 'core/controllers/DB.php';
        $this -> config = include 'core/config/default.php';
        $this -> db = new DB($this -> config['DB']['name'], $this -> config['DB']['user'], $this -> config['DB']['pass'], $this -> config['DB']['host'], $this -> config['DB']['type']);
        $this -> user = $user;
        $this -> id();
        $this -> author();
        $this -> date();
        $this -> count();
    }

    protected function id()
    {
        $query = $this -> db -> getRow("SELECT `id` FROM `posts` WHERE `id_user` = ?", [$this -> user]);
        return $this -> id = $query['id'];
    }

    protected function author()
    {
        $query = $this -> db -> getRow("SELECT `id_user` FROM `posts` WHERE `id` = ?", [$this -> id]);
        if(!empty($query['id_user']))
        {
            return $this -> author = $query['id_user'];
        }
    }

    protected function text()
    {
        $query = $this -> db -> getRow("SELECT `text` FROM `posts` WHERE `id` = ?", [$this -> id]);
        if(!empty($query['text']))
        {
            return $this -> text = $query['text'];
        }
    }

    protected function date()
    {
        $query = $this -> db -> getRow("SELECT `date` FROM `posts` WHERE `id` = ?", [$this -> id]);
        if(!empty($query['date']))
        {
            return $this -> date = $query['date'];
        }
    }

    protected function views()
    {
        $query = $this -> db -> getRow("SELECT `views` FROM `posts` WHERE `id` = ?", [$this -> id]);
        if(!empty($query['views']))
        {
            return $this -> views = $query['views'];
        }
    }

    protected function count()
    {
        $query = $this -> db -> getRow("SELECT count(`id`) FROM `posts` WHERE `id_user` = ?", [$this -> user]);
        return $this -> count = $query["count(`id`)"];
    }

}