<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 04:19 PM
 */

class Database extends PDO
{
    public function __construct()
    { 
        parent::__construct('mysql:host=localhost;dbname=intern;charset=utf8','root','');
    }
}