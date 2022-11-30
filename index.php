<?php
session_start();
include "Router.php";
Router::url($_SERVER['REQUEST_URI']);
$_SESSION['page']['class'] = $class = Router::classInc();
$_SESSION['page']['method'] = $method = Router::methodInc();
$_SESSION['page']['params'] = $params = Router::paramsInc();


if($class == 'action')
{
    $Page = 'core/actions/action.php';
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
}else{
    header("Location: /start");
}