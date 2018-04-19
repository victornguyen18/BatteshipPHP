<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 02:00 PM
 */

class Controller
{
    function __construct()
    {
        $this->view = new View();
    }

    public function loadModel($name){
        $path = '../app/sources/models/' . ucfirst($name).'.php';
        if (file_exists($path)){
            require $path;
            $modelName = ucfirst($name);
            $this->model = new $modelName();
        }
    }
}