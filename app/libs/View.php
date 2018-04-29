<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 02:07 PM
 */

class View
{
    public $data;
    function __construct()
    {
    }

    public function render($name, $noInclude = false)
    {
//        extract($this->data);
        if ($noInclude == true){
            require 'app/sources/views/' . $name . '.php';
        }
        else {
            require '../app/sources/templates/partials/header.php';
            require '../app/sources/views/' . $name . '.php';
            require '../app/sources/templates/partials/footer.php';
        }
    }
    function view($data=array(),$disable = false){
        $this->data = $data;
    }
}