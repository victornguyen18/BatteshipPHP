<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 10:54 AM
 */

class PlayController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        $this->view->render('play/index');
    }
    function battle(){
        $this->view->render('play/battle');
    }

    function shipSetting(){
        $shipName = $_GET['shipName'];
        $row = $_GET['row'];
        $col = $_GET['col'];
        $direction = $_GET['direction'];
        $this->model->shipSetting(Session::get("player"),$shipName,$row,$col,$direction);
    }

    function playGame(){
        $this->model->playGame(Session::get("computer"), Session::get("player"));
    }
}