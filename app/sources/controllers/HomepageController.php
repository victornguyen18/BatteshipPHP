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

    function index(){
        $logged = Session::get('loggedIn');
        $this->view->js = array('js/deal.js', 'js/cart.js');
        $grid = new Grid();
        $grid   ->markMiss(1,2);
        $temp = $grid->getGird();

        $data = array();
        $data['grid'] = $temp;
        $this->view->view($data);
        $this->view->render('homepage/index');
    }

    function detail(){
        $this->view->render('homepage/index');
    }
}