<?php
namespace Controllers\Frontend;

use Controllers\BaseController;
use Models\Attribute;
use Models\Category;
use Models\Feedback;
use Models\Product;

class Products extends BaseController
{
    protected $_module = 'frontend';
    protected $_model;
    protected $_category;
    protected $_feedback;
    protected $_attribute;

    function __construct()
    {
        $this->_model = new Product();
        $this->_category = new Category();
        $this->_feedback = new Feedback();
        $this->_attribute = new Attribute();

    }

    function homes()
    {

        $pages = isset($_GET['pages']) ? $_GET['pages'] : 1;
        $offset = ($pages - 1) * limit;
        $products = $this->_model->getProduct(ord, limit, $offset, '1', '1');
        $totalpage = $this->_model->numRow('defaults', 1);
        $totalpage = ceil($totalpage / limit);
        $category = $this->_category->getCategory();
        if (!empty($products)) {
            return $this->render('products', ['products' => $products, 'category' => $category, 'pages' => $pages, 'totalpage' => $totalpage]);
        } else {
            return false;
        }
    }


    public function cat()
    {
        if (!isset($_GET['catid']) && $_GET['catid'] == "") {
            return false;
        }
        $id = $_GET['catid'];
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 1;
        $offset = ($pages - 1) * limit;
        $products = $this->_model->getProductsCat($id, ord, limit, $offset);
        $totalpage = $this->_model->countValue('category_id', $id, 'defaults', 1);
        $totalpage = ceil($totalpage / limit);
        $category = $this->_category->getAllData();
        if (!empty($products)) {
            return $this->render('products', ['category' => $category, 'products' => $products, 'totalpage' => $totalpage, 'offset' => $offset, 'pages' => $pages]);
        } else {
            return false;
        }


    }


    public function details()
    {
        if (!isset($_GET['id']) && $_GET['id'] == "") {
            header("location:index.php?control=products");
        }
        $id = $_GET['id'];
        $product = $this->_model->getValue($id);
        if (empty($product)) {
            header("location:index.php?control=products");
        }
        $name = $product['name'];
        $price = $product['price'];
        $cat = $product['category_id'];
        $total = $this->_feedback->countFeedback($name);
        $total = ceil($total / limit);
        $feedback = $this->_feedback->getFeedback(ord, $name, limit, 0);
        $mau = isset($_GET['mau']) ? $_GET['mau'] : $product['mau_sac'];
        $dung_luong = isset($_GET['dung_luong']) ? $_GET['dung_luong'] : $product['dung_luong'];
        $color = $this->_model->getAttribute('mau_sac', 'name', $name);
        $data = $this->_model->getAttribute('dung_luong', 'name', $name);
        $offer = $this->_model->getOffer(ord, limit, 0, $price, $cat);
        sort($data);
        if (isset($_GET['dung_luong'])) {
            $dung_luong = substr($dung_luong, 0, -2);
        }
        $product_attr = $this->_model->getDetailProduct($name, $mau, $dung_luong);
        $support = $this->_attribute->getAttribute($id);
        if (!empty($product_attr)) {
            return $this->render('preview', ['product' => $product_attr, 'color' => $color, 'data' => $data, 'attribute' => $support, 'offer' => $offer, 'feedback' => $feedback, 'totalpage' => $total]);
        } else {
            header("location:index.php?control=products&action=details&id=$id");
        }

    }


    function searchPro()
    {
        if (isset($_GET['key']) && $_GET['key'] != "" && !isset($_GET['pages'])) {
            $key = $_GET['key'];
            $_SESSION['key'] = $key;
            $pages = isset($_GET['pages']) ? $_GET['pages'] : 1;
            $offset = ($pages - 1) * limit;
            $products = $this->_model->searchProduct(ord, $key, limit, $offset);
            $totalpage = $this->_model->countSearchProduct($key);
            $totalpage = ceil($totalpage / limit);
            $category = $this->_category->getAllData();
            if (!empty($products)) {
                return $this->render('products', ['category' => $category, 'products' => $products, 'totalpage' => $totalpage, 'offset' => $offset, 'pages' => $pages]);
            } else {
                header("location:index.php?control=products");
            }
        } elseif ($_GET["action"] == "searchPro" && isset($_GET['pages'])) {
            $key = isset($_SESSION['key']) ? $_SESSION['key'] : "";
            $pages = isset($_GET['pages']) ? $_GET['pages'] : 1;
            $offset = ($pages - 1) * limit;
            $products = $this->_model->searchProduct(ord, $key, limit, $offset);
            $totalpage = $this->_model->countSearchProduct($key);
            $totalpage = ceil($totalpage / limit);
            $category = $this->_category->getAllData();
            if (!empty($products)) {
                return $this->render('products', ['category' => $category, 'products' => $products, 'totalpage' => $totalpage, 'offset' => $offset, 'pages' => $pages]);
            } else {
                header("location:index.php?control=products");
            }
        } else {
            header("location:index.php");
        }
    }

    function searchPrice()
    {
        if ($_GET['catid'] == "") {
            return header("location:index.php?control=products");
        }
        $id = substr($_GET['catid'], 0, 1);
        $price1 = 0;
        $price2 = 5000000;
        switch ($id) {
            case '1':
                $price1 = 0;
                $price2 = 5000000;
                break;
            case '2':
                $price1 = 5000000;
                $price2 = 10000000;
                break;
            case '3':
                $price1 = 10000000;
                $price2 = 15000000;
                break;
            case '4':
                $price1 = 15000000;
                $price2 = 20000000;
                break;
            case '5':
                $price1 = 20000000;
                $price2 = 100000000;
                break;
        }
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 1;
        $offset = ($pages - 1) * limit;
        $products = $this->_model->getProductPrice(ord, $price1, $price2, limit, $offset);
        $totalpage = $this->_model->countProductPrice($price1, $price2);
        $totalpage = ceil($totalpage / limit);
        $category = $this->_category->getAllData();
        return $this->render('products', ['category' => $category, 'products' => $products, 'totalpage' => $totalpage, 'offset' => $offset, 'pages' => $pages]);

    }


    function test()
    {
        $pro_id = $_POST['product_id'];
        $offset = $_POST['offset'];
        $product = $this->getData('product', 'product_id', $pro_id);
        $product_name = $product['name'];
        $limit = 5;
        $total = $this->num_rowFeedback($product_name);
        $total = ceil($total / $limit);
        $total = ($total - 1) * $limit;
        $feedback = $this->getFeedback($product_name, $limit, $offset);
        $isLast = "";
        if ($total == $offset) {
            $isLast = true; //  check la cuoi cung
        }
        $html = '';
        foreach ($feedback as $item) {
            $name = $item['user_name'];
            $content = $item['content'];
            $html .=
                "<div  class='div demo' style='border-bottom: 1px dotted grey;padding-top: 10px;'>
                     <span style='font-size: 15px;'>$name:</span>
                     <p style='font-family: arial;padding: 10px 0px 10px 10px;'> - $content</p>
                </div>";
        }

        $r = [
            'html' => $html,
            'is_last' => $isLast
        ];

        echo json_encode($r);
    }

}

?>
