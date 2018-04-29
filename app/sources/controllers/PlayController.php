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
    }

    function playGame(){
        $this->model->playGame(Session::get("computer"), Session::get("player"));
    }
}