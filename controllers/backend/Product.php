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

    public function validateProduct()
    {

        $valid = $this->_productValidators->validateProducts($this->getParams());
        if (!$valid) {
            setFlashError($this->_productValidators->getErrors());
            return false;
        }
        if ($_FILES['image']['name'] == '') {
            $this->_productValidators->addErrors('error', 'Bạn chưa chọn ảnh');
            setFlashError($this->_productValidators->getErrors());
            return false;
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
            return false;
        }
        if ($file_size > 2097152) {
            $this->_productValidators->addErrors('error', 'File ảnh ko đúng');
            setFlashError($this->_productValidators->getErrors());
            return false;
        }
        move_uploaded_file($file_tmp, "public/common/images/" . $file_name);
        return $file_name;
    }

    public function viewAddNew()
    {
        $product = [];
        $pro_id = array_get($this->getParams(), 'id');
        if ($pro_id != '') {
            $product = $this->_productModel->getData(['product_id' => $pro_id]);
        }
        $category = $this->_category->getData([]);
        $attribute = $this->_attribute->getData([]);
        $this->render('productadd', ['product' => '', 'category' => $category, 'attribute' => $attribute, 'product' => $product]);
    }

    protected function getData($file_name)
    {
        $name = array_get($this->getParams(), 'name');   ///$_POST["name"];
        $category = array_get($this->getParams(), 'category');  ///$_POST["category"];
        $sl = array_get($this->getParams(), 'sl');   ///$_POST["sl"];
        $color = array_get($this->getParams(), 'color');  //$_POST["color"];
        $data = array_get($this->getParams(), 'data'); ////$_POST["data"];
        $price = array_get($this->getParams(), 'price');  ///$_POST["price"];
        $manhinh = array_get($this->getParams(), 'manhinh');  ///$_POST["manhinh"];
        $hdh = array_get($this->getParams(), 'hdh');  ///$_POST["hdh"];
        $cpu = array_get($this->getParams(), 'cpu'); ////$_POST["cpu"];
        $pin = array_get($this->getParams(), 'pin');  // $_POST["pin"];
        $cameratruoc = array_get($this->getParams(), 'cameratruoc');  //$_POST["cameratruoc"];
        $camerasau = array_get($this->getParams(), 'camerasau');   ///$_POST["camerasau"];
        $phukien = array_get($this->getParams(), 'phukien'); ///$_POST["phukien"];
        $defaults = isset($_POST["defaults"]) ? 1 : 0;
        $ad_id = $_SESSION["admin_id"];
        $ram = array_get($this->getParams(), 'ram');     ///$_POST["ram"];
        $date = getdate();
        $date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        $array = [
            'category_id' => $category,
            'ad_id' => $ad_id,
            'name' => $name,
            'so_luong' => $sl,
            'mau_sac' => $color,
            'img' => $file_name,
            'ram' => $ram,
            'dung_luong' => $data,
            'price' => $price,
            'man_hinh' => $manhinh,
            'he_dieu_hanh' => $hdh,
            'cpu' => $cpu,
            'dl_pin' => $pin,
            'camera_truoc' => $cameratruoc,
            'camera_sau' => $camerasau,
            'phukien' => $phukien,
            'date' => $date,
            'defaults' => $defaults
        ];
        return $array;
    }

    public function addNew()
    {
        $valid = $this->validateProduct();
        if ($valid == false){
            return redirect(url([
                'control' => 'product',
                'action' => 'viewAddNew'
            ]));
        }
        $data = $this->getData($valid);

        $this->_productModel->insert($data);

        return $this->addNewAttribute();
    }

    public function addNewAttribute()
    {

        if (!empty($_POST["attribute"])) {

            $product = $this->_productModel->getData(['ord' => 'DESC', 'limit' => 1, 'offset' => 0]);

            $product_id = $product[0]['product_id'];

            foreach ($_POST["attribute"] as $value) {
                $this->_detail->insert(['product_id'=>$product_id,'attribute_id'=>$value]);
            }

            return redirect(url([
                'control' => 'product'
            ]));

        }
        return redirect(url([
            'control' => 'product'
        ]));
    }

    public function updateProduct(){
        $this->_category->delete(4444444444);

        var_dump($this->_category->error);
        if (empty($this->_category->error)){
            echo "có";
        }
        $this->_category->commit();
    }

}