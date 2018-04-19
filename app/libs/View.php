<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 02:07 PM
 */

class View
{
    function __construct()
    {
    }

    public function render($name, $noInclude = false)
    {

        if ($noInclude == true){
            require 'app/sources/views/' . $name . '.php';
        }
        else {
            require '../app/sources/templates/partials/header.php';
            require '../app/sources/views/' . $name . '.php';
            require '../app/sources/templates/partials/footer.php';
        }
    }
}