<?php
/**
 * Created by CHARIZARD(pncuong.net@gmail.com).
 * User: CHARIZARD
 * Date: 10/21/2016
 * Time: 11:31 AM
 */

header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
define("APP_DIR",dirname(__DIR__));
require_once  APP_DIR.'/apps/libs/autoload.php';
require_once  APP_DIR.'/apps/config/config.php';
Session::init();
$router = require_once  APP_DIR.'/apps/config/router.php';
try {
   $app = new App();
    $app->run($router);
} catch (Exception $e) {
//   require '404.php';
    echo  $e->getMessage(), "\n";
}