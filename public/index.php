<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Use an autoloader!
require '../app/libs/App.php';
require '../app/libs/Controller.php';
require '../app/libs/Model.php';
require '../app/libs/View.php';

//Library
require '../app/libs/Database.php';
require '../app/libs/Session.php';

require '../app/config/paths.php';
require '../app/config/database.php';
Session::init();
$app = new App();