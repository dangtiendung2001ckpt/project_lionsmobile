<?php

namespace Controllers\Frontend;


use Controllers\BaseController;
use Models\Product;

class Home extends BaseController
{
    protected $_module = 'frontend';
    protected $_model;

    function __construct()
    {
        $this->_model = new Product();


    }

    function homes()
    {
       $products = $this->_model->getData(['defaults'=>'1']);
        return $this->render('home',['products'=>$products]);
    }


}
?>
