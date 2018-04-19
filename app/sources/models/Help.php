<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 02:36 PM
 */
class Help extends Model{
    function __construct()
    {
        parent::__construct();
    }
    public function other(){
        echo 'inside help <br>';
    }
}