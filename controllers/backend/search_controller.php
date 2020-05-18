<?php
include_once 'Models/delete.php';
class SearchController extends DeleteValue {
    protected $_module='backend';
    protected $_control="products";
    function homes(){
        if (isset($_GET['key']) && $_GET['key'] != ""){
            $key = isset($_GET['key']) ? $_GET['key'] : "";
            $_SESSION['key_pro'] = $key;
            $limit=8;
            $pages= isset($_GET['pages']) ? $_GET['pages'] : 1;
            $offset=($pages - 1) * $limit;
            $products=$this->searchProAdmin($key,$limit,$offset);
            $totalpage = $this->num_row_searchPro($key);
            $totalpage =ceil($totalpage / $limit);
            return $this->render('search',$totalpage,$offset,$pages,['products'=>$products]);
        }elseif(isset($_SESSION['key_pro'])){
            $key = $_SESSION['key_pro'];
            $limit=8;
            $pages= isset($_GET['pages']) ? $_GET['pages'] : 1;
            $offset=($pages - 1) * $limit;
            $products=$this->searchProAdmin($key,$limit,$offset);
            $totalpage = $this->num_row_searchPro($key);
            $totalpage =ceil($totalpage / $limit);
            return $this->render('search',$totalpage,$offset,$pages,['products'=>$products]);
        }else{
            header("location:index.php?module=backend&control=products");
        }

    }

    public function render($file,$totalpage,$offset,$pages,$data=[])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/sidebar.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }


}
?>

