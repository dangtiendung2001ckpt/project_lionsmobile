<?php


namespace Controllers\Backend;


use Controllers\BaseController;
use Models\Attribute;
use Models\Category;
use Models\DetailProduct;
use Validators\ProductsValidator;

class Product extends BaseController
{
    protected $_module = 'backend';
    protected $_productModel;
    protected $_category;
    protected $_attribute;
    protected $_productValidators;
    protected $_detail;

    public function __construct()
    {
        $this->_productModel = new  \Models\Product();
        $this->_category = new Category();
        $this->_attribute = new Attribute();
        $this->_productValidators = new ProductsValidator();
        $this->_detail = new DetailProduct();
    }

    public function homes()
    {
        $limit = limit;
        $pages = $this->pages('pages');
        $offset = $this->offset($pages);
        $total = $this->_productModel->count([]);
        $total = $this->totalPage($total);
        $products = $this->_productModel->getData(['ord' => 'desc', 'limit' => $limit, 'offset' => $offset]);
        return $this->render('productlist', ['products' => $products, 'pages' => $pages, 'totalpage' => $total]);

    }

    public function viewAddNew()
    {
        $category = $this->_category->getData([]);
        $attribute = $this->_attribute->getData([]);
        $this->render('productadd', ['product' => '', 'category' => $category, 'attribute' => $attribute]);
    }

    public function addNew()
    {
        if (!$this->_productValidators->validateProducts($this->getParams())) {
            setFlashError($this->_productValidators->getErrors());
            return redirect(url([
                'control' => 'product',
                'action' => 'viewAddNew'
            ]));
        }
        if ($_FILES['image']['name'] == '') {
            $this->_productValidators->addErrors('error', 'Bạn chưa chọn ảnh');
            setFlashError($this->_productValidators->getErrors());
            return redirect(url([
                'control' => 'product',
                'action' => 'viewAddNew'
            ]));
        }
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = explode('.', $_FILES['image']['name']);
        $file_ext = end($file_ext);
        $file_ext = strtolower($file_ext);
        $expensions = array("jpeg", "jpg", "png");
        if (in_array($file_ext, $expensions) === false) {
            $this->_productValidators->addErrors('error', 'File ảnh ko đúng');
            setFlashError($this->_productValidators->getErrors());
            return redirect(url([
                'control' => 'product',
                'action' => 'viewAddNew'
            ]));
        }
        if ($file_size > 2097152) {
            $this->_productValidators->addErrors('error', 'File ảnh ko đúng');
            setFlashError($this->_productValidators->getErrors());
            return redirect(url([
                'control' => 'product',
                'action' => 'viewAddNew'
            ]));
        }
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
        move_uploaded_file($file_tmp,"public/common/images/".$file_name);
        $date=getdate();
        $date=$date['year'].'-'.$date['mon'] .'-'.$date['mday'];
        $this->_productModel->insert(['category_id'=>$category,'ad_id'=>$ad_id,'name'=>$name,'so_luong'=>$sl,'mau_sac'=>$color,'img'=>$file_name,'ram'=>$ram,'dung_luong'=>$data,'price'=>$price,'man_hinh'=>$manhinh,'he_dieu_hanh'=>$hdh,'cpu'=>$cpu,'dl_pin'=>$pin,'camera_truoc'=>$cameratruoc,'camera_sau'=>$camerasau,'phukien'=>$phukien,'date'=>$date,'defaults'=>$defaults]);
        if (empty($_POST["attribute"])){
            return redirect(url([
                'control' => 'product'
            ]));
        }
        $product_id =$this->_productModel->getData(['ord'=>'DESC','limit'=>1,'offset'=>0]);
        $product_id =$product_id[0]['product_id'];
        foreach ($_POST["attribute"] as $value){
            $this->_detail->insert(['product_id'=>$product_id,'attribute_id'=>$value]);
        }
        return redirect(url([
            'control' => 'product'
        ]));
    }
}