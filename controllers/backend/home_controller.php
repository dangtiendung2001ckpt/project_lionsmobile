<?php
class HomeController
{
    protected $_module = 'backend';
    function homes()
    {
        return $this->render('home');
    }
    public function render($file)
    {
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/sidebar.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }

}
?>