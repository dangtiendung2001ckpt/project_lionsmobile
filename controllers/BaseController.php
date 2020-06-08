<?php


namespace Controllers;


class BaseController
{
    protected $_module;
    protected  function render($file, $data = [])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/menu.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }

    protected function header($control,$action,$id){
        $str="location:index.php?module=$this->_module";
        if (!empty($control)){
            $str.="&control=$control";
        }
        if (!empty($action)){
            $str.="&action=$action";
        }
        if (!empty($id)){
            $str.="&id=$id";
        }
        header($str);
    }
    protected function pages($name){
        $pages = isset($_GET[$name]) ? $_GET[$name] : 1;

        return (int)$pages;
    }
    protected function totalPage($totalpage){
        $totalpage = ceil($totalpage / limit);
        return $totalpage;
    }
    protected function offset($pages){
        $offset = ($pages - 1) * limit;
        return $offset;
    }

    public function getParam($key, $default = null)
    {
        $params = $this->getParams();
        return array_get($params, $key, $default);
    }

    public function getParams()
    {
        return $_REQUEST;
    }
}