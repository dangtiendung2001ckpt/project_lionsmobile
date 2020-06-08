<?php
include_once 'Models/showdata.php';
class CartController extends ShowData {
    protected $_module = 'frontend';
    function homes()
    {
        $cart=[];
        if (isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $cart = $this->getallOrderUser('chốt đơn','đang giao hàng',$id);
        }
        return $this->render('cart',['cart'=>$cart]);
    }
    public function render($file,$data=[])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/menu.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }
    function cart(){
        if (isset($_GET['id']) && $_GET['id'] != ""){
            $id=$_GET["id"];
            if (isset($_SESSION['user_id'])){
                $newProducts=[];
                if (isset($_POST["submit"]) && $_POST["soluong"] >=1 && $_POST["soluong"] <=5 ){
                    $products=$this->getAllData('product');
                    foreach ($products as $value){
                        $newProducts[$value['product_id']] = $value;
                    }
                    if (!isset($_SESSION['cart']) && empty($_SESSION['cart'])){
                        $newProducts[$id]['qty']=$_POST["soluong"];
                        $newProducts[$id]['tong_gia']=$newProducts[$id]['qty'] * $newProducts[$id]['price'];
                        $_SESSION['cart'][$id] =$newProducts[$id];
                        header("location:index.php?control=cart");
                    }else{
                        if (array_key_exists($id,$_SESSION['cart'])){
                            $_SESSION['cart'][$id]['qty'] = $_POST["soluong"];
                            if ($_SESSION['cart'][$id]['qty'] >5){
                                $_SESSION['cart'][$id]['qty'] =5;
                                $_SESSION['cart'][$id]['tong_gia']=$_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
                                header("location:index.php?control=cart");
                            }else{
                                $_SESSION['cart'][$id]['tong_gia']=$_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
                                header("location:index.php?control=cart");
                            }
                        }else{
                            $newProducts[$id]['qty']=$_POST["soluong"];
                            $newProducts[$id]['tong_gia']=$newProducts[$id]['qty'] * $newProducts[$id]['price'];
                            $_SESSION['cart'][$id] =$newProducts[$id];
                            header("location:index.php?control=cart");
                        }
                    }
                }else{
                    header("location:index.php?control=products&action=details&id=$id");
                }
            }else{
                header("location:index.php?control=user&int=null&proid=$id");
            }
        }else{
            header("location:index.php?control=cart");
        }

    }



    function del(){
        if (isset($_GET['id']) && $_GET['id'] != ""){
            $id=$_GET["id"];
            unset($_SESSION['cart'][$id]);
            header("location:index.php?control=cart");
        }else{
            header("location:index.php?control=cart");
        }
    }
    function order(){
       if (isset($_SESSION["user_id"]) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
           $provincial=$this->getAllData('provincial');
           $user = $this->getData('user','user_id',$_SESSION["user_id"]);
           return $this->render('login',['provincial'=>$provincial,'user'=>$user]);
       }else{
           header("location:index.php?control=products");
       }
    }
    function ordercart(){
        if (isset($_SESSION["user_id"]) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            if (isset($_POST["submit"]) && $_POST["phone"] != "" && $_POST["provincial"] != "" && $_POST["district"] != "" && $_POST["ward"] != "" && $_POST["address"] != ""){
                $dates=getdate();
                $date=$dates['year'].'-'.$dates['mon'] .'-'.$dates['mday'];
                $user_id=$_SESSION["user_id"];
                    $this->updateUser($_POST["phone"],$_POST["provincial"],$_POST["district"],$_POST["ward"],$_POST["address"],$_SESSION["user_id"]);
                    echo $date;
                   $this->insertValue('orders','order_id','user_id',$user_id,'order_date',$date);
                $order_id= $this->getDatas('orders','order_id','DESC',1,0);
                foreach ($order_id as $value){
                    $order_id=$value["order_id"];
                }
                foreach ($_SESSION['cart'] as $value){
                    $this->insertAuxiliary('order_detail','order_detail_id','order_id','product_id','price','sl',$order_id,$value['product_id'],$value['tong_gia'],$value['qty']);
                }
                unset($_SESSION['cart']);
                header("location:index.php?control=cart&suc=suc");
            }else{
                header("location:index.php?control=cart&action=order&int=address");
            }
        }else{
            header("location:index.php?control=products");
        }
    }
}
?>
