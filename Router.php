<?php

class Router
{
    public static $url, $class, $method, $params;
    public static function url($url)
    {
        if ($url[0] == '/')
        {
            $url = substr($url, 1);
        }
        if (empty($url))
        {
            header("Location: /start");
        }else{
            self::$url = $url;
        }
    }

    public static function  classInc()
    {
        $end = strpos(self::$url, '?');
        if (!empty($end))
        {
            return self::$class  = substr(self::$url, 0, $end);
        }else{
            return self::$class = self::$url;
        }
    }
    public static function methodInc()
    {
        $start = strpos(self::$url,'?');
        $end = strpos(self::$url,'?');

        if(!empty($start))
        {
            if(empty($end))
            {
                return self::$method = substr(self::$url, $start + 1);
            }
            else{
                return self::$method = substr(self::$url, $start + 1, $end - $start - 1);
            }

        }else{
            return self::$method = 'main';
        }
    }

    public static function paramsInc()
    {
        $start = strpos(self::$url, '=');
        if (!empty($start))
        {
            return self::$params =  substr(self::$url, $start + 1);
        }else{
            return '';
        }
    }



}