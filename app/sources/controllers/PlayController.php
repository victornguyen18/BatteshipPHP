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

    function chooseMode(){
        $this->view->render('play/chooseMode');
    }

    function chooseDifficulty(){
        $this->view->render('play/chooseDifficulty');
    }

    function playGame(){
        $this->model->playGame(Session::get("computer"), Session::get("player"));
    }
}