<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 11:02 AM
 */

class GridController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        $this->view->render('help/index');
    }

    public function other($arg = false) {
        $this->model->other();
    }
}