<?php
include_once 'models/showdata.php';
class HomeController extends ShowData
{
    protected $_module = 'frontend';
    function homes()
    {
        $products = $this->getSomeProduct('product','product_id','DESC',12,0,'defaults',1);
        return $this->render('home',['products'=>$products]);
    }
    public function render($file,$data=[])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/menu.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }

}

?>
