<?php
session_start();                                                //запуск сессии
include "Router.php";                                           //подкл. файл маршрутизации
Router::url($_SERVER['REQUEST_URI']);                           //из глобального массива SERVER получаем строку запроса и предаем методу url
$_SESSION['page']['class'] = $class = Router::classInc();       //метод возвращающий имя подключаемого класса
$_SESSION['page']['method'] = $method = Router::methodInc();    //метод возвращающий имя подключаемого метода класса
$_SESSION['page']['params'] = $params = Router::paramsInc();    //метод возвращающий имя параметры метода

if($class == 'action')
{
    $Page = 'core/actions/action.php';
}
elseif ($class == 'upload')
{
    $Page = 'core/actions/upload.php';
}
elseif ($class == 'post')
{
    $Page = 'core/controllers/Post.php';
}
elseif ($class == 'friends')
{
    include 'core/classes/Main.php';
    $Page = 'core/classes/friends.php';
}else{
    include 'core/classes/Main.php';
    $Page = 'core/classes/' . $_SESSION['page']['class'] . '.php';
}
if(file_exists($Page))
{
    $method = '_' . $method . '_';
    include $Page;
    $page = new $class();
    $page -> $method($params);
}else{ //если запрашивается несуществующий класс, то переход на главную страницу
    header("Location: /start");
}

//$list = ['action','upload','post'];
//foreach ($list as $val)
//{
//    if ($class == $val)
//    {
//        $Page = 'core/actions/' . $val . '.php';
//    } else {
//        include_once 'core/classes/Main.php';
//        $Page = 'core/classes/' . $_SESSION['page']['class'] . '.php';
//    }
//}
//if($class == 'action')
//{
//    $Page = 'core/actions/action.php';
//}
//elseif ($class == 'upload')
//{
//    $Page = 'core/actions/upload.php';
//}else{
//    include 'core/classes/Main.php';
//    $Page = 'core/classes/' . $_SESSION['page']['class'] . '.php';
//}