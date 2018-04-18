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
require  '../apps/libs/Workerman/Autoloader.php';
require  '../apps/libs/Phpsocketio/autoload.php';
use Workerman\Worker;
use PHPSocketIO\SocketIO;

// listen port 2021 for socket.io client
$io = new SocketIO(2388);
$io->on('connection', function($socket)use($io){
    $socket->on('chat message', function($msg)use($io){
        echo  $msg;
        $io->emit('message', $msg);
    });
});

Worker::runAll();
