<?php
include_once 'Models/delete.php';
class CartController extends DeleteValue
{
    protected $_module='backend';
    function homes(){
        $limit=15;
        $pages= isset($_GET['pages']) ? $_GET['pages'] : 1;
        $offset=($pages - 1) * $limit;
        $cart=$this->getOrders($limit,$offset,'chốt đơn','đang giao hàng');
        $totalpage = $this->num_rowOrder('order_detail','trang_thai','chốt đơn','trang_thai','đang giao hàng');
        $totalpage =ceil($totalpage / $limit);
        return $this->render('cart',$totalpage,$offset,$pages,['cart'=>$cart]);

    }
    public function render($file,$totalpage,$offset,$pages,$data=[])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/sidebar.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }
    function del(){
        if (isset($_SESSION['admin']) && isset($_GET['id']) && $_GET['id'] != "") {
            $id = $_GET['id'];
            $order= $_GET['orderid'];
            $pages=$_GET['page'];
            $trang_thai = $this->getData('order_detail','order_detail_id',$id);
            if ($trang_thai['trang_thai'] == "đang giao hàng"){
                $pro_id = $trang_thai['product_id'];
                $pro =$this->getData('product','product_id',$pro_id);
                $so_luong = $pro['so_luong'];
                $sl=$trang_thai['sl'];
                $so_luong = $so_luong + $sl;
                $this->updateValue('product','so_luong',$so_luong,'product_id',$pro_id);
            }
            $this->delete('order_detail','order_detail_id',$id);
             $num = $this->row('order_detail','order_id',$order);
             if ($num == 0){
                 $this->delete('orders','order_id',$order);
             }
            header("location:index.php?module=$this->_module&control=cart&pages=$pages");
        }

    }

    function delcart(){
        if (isset($_SESSION['admin']) && isset($_GET['id']) && $_GET['id'] != "") {
            $id = $_GET['id'];
            $pages=$_GET['page'];
            $trang_thai=$this->getData('order_detail','order_id',$id);
            if ($trang_thai['trang_thai'] == "đang giao hàng"){
                $order= $this->getAllPro('order_detail','order_id',$id);
                foreach ($order as $value){
                    $product_id=$value['product_id'];
                    $product = $this->getData('product','product_id',$product_id);
                    $so_luong = $product['so_luong'];
                    $sl=$value['sl'];
                    $so_luong = $so_luong + $sl;
                    $this->updateValue('product','so_luong',$so_luong,'product_id',$product_id);
                }
            }
            $this->delete('order_detail','order_id',$id);
            $this->delete('orders','order_id',$id);
            header("location:index.php?module=$this->_module&control=cart&pages=$pages");
        }

    }
    function update(){
        if (isset($_GET['id'])  && $_GET['id'] != ""){
            $id=$_GET['id'];
            $pages=$_GET['page'];
            $trang_thai= $_GET['orderid'];
            if ($trang_thai== "chốt đơn"){
                $order= $this->getAllPro('order_detail','order_id',$id);
                foreach ($order as $value){
                    $product_id=$value['product_id'];
                    $product = $this->getData('product','product_id',$product_id);
                    $so_luong = $product['so_luong'];
                    $sl=$value['sl'];
                    $so_luong = $so_luong - $sl;
                    $this->updateValue('product','so_luong',$so_luong,'product_id',$product_id);
                }
                $this->updateValue('order_detail','trang_thai','đang giao hàng','order_id',$id);
                header("location:index.php?module=$this->_module&control=cart&pages=$pages");
            }elseif ($trang_thai=="đang giao hàng"){
                $this->updateValue('order_detail','trang_thai','đã thanh toán','order_id',$id);
                header("location:index.php?module=$this->_module&control=cart&action=cartlist");
            }
        }
    }
    function cartlist(){
        $limit=10;
        $pages= isset($_GET['pages']) ? $_GET['pages'] : 1;
        $offset=($pages - 1) * $limit;
        $cart=$this->getOrders($limit,$offset,'đã thanh toán','');
        $totalpage = $this->num_rowOrder('order_detail','trang_thai','đã thanh toán','trang_thai','');
        $totalpage =ceil($totalpage / $limit);
        return $this->render('cartlist',$totalpage,$offset,$pages,['cart'=>$cart]);
    }
}

?>