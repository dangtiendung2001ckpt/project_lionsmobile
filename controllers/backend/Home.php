<?php


namespace Controllers\Backend;


use Controllers\BaseController;

class Home extends BaseController
{
    protected $_module = 'backend';
    function homes(){
        return $this->render('home',[]);
    }
}