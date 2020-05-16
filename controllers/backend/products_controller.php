<?php
include_once 'models/delete.php';
class ProductsController extends DeleteValue {
    protected $_module='backend';
    protected $_control="products";
    function homes(){
        $limit=8;
        $pages= isset($_GET['pages']) ? $_GET['pages'] : 1;
        $offset=($pages - 1) * $limit;
        $products=$this->getDatas('product','product_id','DESC',$limit,$offset);
        $totalpage = $this->num_rowTable('product');
        $totalpage =ceil($totalpage / $limit);
        return $this->render('productlist',$totalpage,$offset,$pages,['products'=>$products]);

    }
    public function quickAdd(){
        $product=[];
        $attributes=[];
        if (isset($_GET["id"])){
            $id=$_GET["id"];
            $product = $this->getProduct($id);
            $attributes=$this->getAttribute($id);
        }
        $category=$this->getAllData('category');
        $attribute=$this->getAllData('attribute');
        return $this->render('productadd','','','',['category'=>$category,'attribute'=>$attribute,'product'=>$product,'attributes'=>$attributes]);
    }

    public function viewAddnewProduct(){
        $product=[];
        $attributes=[];
        if (isset($_GET["id"])){
            $id=$_GET["id"];
            $product = $this->getProduct($id);
            $attributes=$this->getAttribute($id);
        }
        $category=$this->getAllData('category');
        $attribute=$this->getAllData('attribute');
        return $this->render('productadd','','','',['category'=>$category,'attribute'=>$attribute,'product'=>$product,'attributes'=>$attributes]);
    }
    public function render($file,$totalpage,$offset,$pages,$data=[])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/sidebar.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }


    public function addnewProduct(){
        if (isset($_FILES['image']) && $_FILES['image']['name'] != ""){
            if (isset($_POST["submit"]) && $_POST["name"]!="" && $_POST["category"]!="" && $_POST["sl"]!="" && $_POST["color"]!="" && $_POST["data"]!="" && $_POST["price"]!=""  && $_POST["manhinh"]!="" && $_POST["hdh"]!="" && $_POST["cpu"]!="" && $_POST["cameratruoc"]!="" && $_POST["camerasau"]!="" && $_POST["phukien"]!="" && $_POST["pin"]!="" && $_POST["ram"]!=""){
                $name=$_POST["name"];
                $category=$_POST["category"];
                $sl=$_POST["sl"];
                $color=$_POST["color"];
                $data=$_POST["data"];
                $price=$_POST["price"];
                $manhinh=$_POST["manhinh"];
                $hdh=$_POST["hdh"];
                $cpu=$_POST["cpu"];
                $pin=$_POST["pin"];
                $cameratruoc=$_POST["cameratruoc"];
                $camerasau=$_POST["camerasau"];
                $phukien=$_POST["phukien"];
                $defaults=isset($_POST["defaults"]) ? 1 : 0;
                $ad_id=$_SESSION["admin_id"];
                $ram=$_POST["ram"];
                $errors= array();
                $file_name=$_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                //$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                $file_ext=explode('.',$_FILES['image']['name']);
                $file_ext=end($file_ext);
                $file_ext=strtolower($file_ext);
                $expensions= array("jpeg","jpg","png");
              if (in_array($file_ext,$expensions) === false){
                  header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&str=img");
              }elseif ($file_size > 2097152){
                  header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&str=img");
              }else{
                  move_uploaded_file($file_tmp,"public/common/images/".$file_name);
                   $date=getdate();
                   $date=$date['year'].'-'.$date['mon'] .'-'.$date['mday'];
                  $this->insertProducts($category,$ad_id,$name,$sl,$color,$file_name,$ram,$data,$price,$manhinh,$hdh,$cpu,$pin,$cameratruoc,$camerasau,$phukien,$date,$defaults);
                                    if (!empty($_POST["attribute"])){
                                        $pro_id= $this->getDatas('product','product_id','DESC',1,0);
                                        foreach ($pro_id as $value){
                                            $product_id=$value["product_id"];
                                        }
                                        $attribute=$_POST["attribute"];
                                        foreach ($attribute as $value){
                                           $this->insertValue('detail_product','detail_product_id','product_id',$product_id,'attribute_id',$value);
                                        }
                                        header("location:index.php?module=$this->_module&control=$this->_control");
                                    }else{
                                        header("location:index.php?module=$this->_module&control=$this->_control");
                                    }
              }
            }else{
                header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&str=null");
            }
        }else{
            header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&str=null");
        }

    }



    public function delproduct(){
            if (isset($_SESSION['admin']) && isset($_GET['id']) && $_GET['id'] != ""){
                $id = $_GET['id'];
                $pages= $_GET['page'];
                $num =$this->row('order_detail','product_id',$id);
                if ($num > 0){
                    header("location:index.php?module=$this->_module&control=$this->_control&pages=$pages&suc=delpro");
                }else{
                    $num_row=$this->row('detail_product','product_id',$id);
                    if ($num_row > 0){
                        $this->delete('detail_product','product_id',$id);
                    }
                    $num_cmt = $this->row('feedback','product_id',$id);
                    if ($num_row > 0){
                        $this->delete('feedback','product_id',$id);
                    }
                    $this->delete('product','product_id',$id);
                    header("location:index.php?module=$this->_module&control=$this->_control&pages=$pages&suc=del");
                }
            }else{
                header("location:index.php?module=$this->_module&control=login");
            }
        }



        public function updateProduct(){
        $id=$_GET['id'];
            if (isset($_FILES['image']) && $_FILES['image']['name'] != ""){
                if (isset($_POST["submit"]) && $_POST["name"]!="" && $_POST["category"]!="" && $_POST["sl"]!="" && $_POST["color"]!="" && $_POST["data"]!="" && $_POST["price"]!=""  && $_POST["manhinh"]!="" && $_POST["hdh"]!="" && $_POST["cpu"]!="" && $_POST["cameratruoc"]!="" && $_POST["camerasau"]!="" && $_POST["phukien"]!="" && $_POST["pin"]!="" && $_POST["ram"]!=""){
                    $name=$_POST["name"];
                    $category=$_POST["category"];
                    $sl=$_POST["sl"];
                    $color=$_POST["color"];
                    $data=$_POST["data"];
                    $price=$_POST["price"];
                    $manhinh=$_POST["manhinh"];
                    $hdh=$_POST["hdh"];
                    $cpu=$_POST["cpu"];
                    $pin=$_POST["pin"];
                    $cameratruoc=$_POST["cameratruoc"];
                    $camerasau=$_POST["camerasau"];
                    $phukien=$_POST["phukien"];
                    $defaults=isset($_POST["defaults"]) ? 1 : 0;
                    $ad_id=$_SESSION["admin_id"];
                    $ram=$_POST["ram"];
                    $id=$_GET["id"];
                    $errors= array();
                    $file_name=$_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $file_type = $_FILES['image']['type'];
                    //$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                    $file_ext=explode('.',$_FILES['image']['name']);
                    $file_ext=end($file_ext);
                    $file_ext=strtolower($file_ext);
                    $expensions= array("jpeg","jpg","png");
                    if (in_array($file_ext,$expensions) === false){
                        header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&str=img");
                    }elseif ($file_size > 2097152){
                        header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&str=img");
                    }else{
                        move_uploaded_file($file_tmp,"public/common/images/".$file_name);
                        $date=getdate();
                        $date=$date['year'].'-'.$date['mon'] .'-'.$date['mday'];
                        $this->updateProducts($category,$ad_id,$name,$sl,$color,$file_name,$ram,$data,$price,$manhinh,$hdh,$cpu,$pin,$cameratruoc,$camerasau,$phukien,$date,$defaults,$id);
                        $this->delete('detail_product','product_id',$id);
                        if (!empty($_POST["attribute"])){
                            $attribute=$_POST["attribute"];
                            foreach ($attribute as $value){
                                $this->insertValue('detail_product','detail_product_id','product_id',$id,'attribute_id',$value);
                                header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&suc=addnew&suc=update");
                            }
                        }else{
                            header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&suc=addnew&suc=update");
                        }
                    }
                }else{
                    header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&str=null&id=$id");
                }
            }else{
                header("location:index.php?module=$this->_module&control=$this->_control&action=viewAddnewProduct&str=null&id=$id");
            }
    }
}
?>

