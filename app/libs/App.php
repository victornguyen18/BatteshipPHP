<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 01:42 PM
 */

class App
{
    function __construct()
{
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    if(empty($url[0])){
        require '../app/sources/controllers/HomepageController.php';
        $controller = new HomepageController();
        $controller->index();
        return false;
    }
    $file = '../app/sources/controllers/' . ucfirst($url[0]) . 'Controller.php';
    if (file_exists($file)) {
        require $file;
    } else {
        $this->error($url[0]);
        return false;
    }
    $nameController = ucfirst($url[0]).'Controller';
    $controller = new $nameController();
    $controller->loadModel($url[0]);
    if (isset($url[2])) {
        if (method_exists($controller,$url[1])) {
            $controller->{$url[1]}($url[2]);
        } else{
            $this->error($url[0]);
        }
    } else {
        if (isset($url[1])) {
            if (method_exists($controller,$url[1])) {
                $controller->{$url[1]}(); // Call object.[url[1]]
            }
            else{
                $this->error();
            }
        }
        else{
            $controller->index();
        }
    }
}
    function error(){
        require '../app/sources/controllers/ErrormsgController.php';
        $controller = new ErrormsgController();
        $controller->index();
        return false;
    }
}