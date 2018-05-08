<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 10:54 AM
 */

class HomepageController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $player = Session::get('player');
        Session::destroyAll();
        Session::set('player', $player);
        $this->view->render('homepage/index');
    }

    function detail()
    {
        $this->view->render('homepage/index');
    }

}