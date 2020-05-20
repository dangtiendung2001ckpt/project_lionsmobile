<?php
namespace Controllers\Frontend;

use Controllers\BaseController;
use Controllers\Valued;
use Models\Attribute;
use Models\Category;
use Models\Feedback;
use Models\Product;

class Products extends BaseController
{
    protected $_module = 'frontend';
    protected $_control = "products";
    protected $_products;
    protected $_category;
    protected $_feedback;
    protected $_attribute;
    protected $_valued;

    function __construct()
    {
        $this->_products = new Product();
        $this->_category = new Category();
        $this->_feedback = new Feedback();
        $this->_attribute = new Attribute();
        $this->_valued = new Valued();

    }


    function homes()
    {

        $totalpage = $this->_products->numRow('defaults', 1);
        $pages = $this->pages('pages');
        $totalpage = $this->totalPage($totalpage);
        if ($pages == 0 && $pages > $totalpage) {
            return $this->header('', '', '');
        }
        $offset = $this->offset($pages);
        $products = $this->_products->getData('', limit, $offset, 'defaults', 1);
        $category = $this->_category->getData('', '', '', '', '');
        if (empty($products)) {
            return $this->header('', '', '');
        }
        return $this->render('products', ['products' => $products, 'category' => $category, 'pages' => $pages, 'totalpage' => $totalpage]);
    }


    public function cat()
    {
        $id = $this->_valued->getParam('catid', 'notnull');
        if ($id == false) {
            return $this->header($this->_control, '', '');
        }
        $id = (int)$id;
        $pages = $this->pages('pages');
        $offset = $this->offset($pages);
        $totalpage = $this->_products->numRow('category_id', $id);
        $totalpage = $this->totalPage($totalpage);
        $category = $this->_category->getData('', '', '', '', '');
        $products = $this->_products->getData('', limit, $offset, 'category_id', $id);
        if (empty($products)) {
            return false;
        }
        return $this->render('products', ['category' => $category, 'products' => $products, 'totalpage' => $totalpage, 'pages' => $pages]);
    }


    public function details()
    {
        $id = $this->_valued->getParam('id', 'notnul');
        if ($id == false) {
            return $this->header($this->_control, '', '');
        }
        $id = (int)$id;
        $product = $this->_products->getData('', '10', '0', 'product_id', $id);
        if (empty($product)) {
            header("location:index.php?control=products");
        }
        $name = $product[0]['name'];
        $price = $product[0]['price'];
        $cat = $product[0]['category_id'];
        $feedback = $this->_feedback->getFeedback(ord, $name, limit, '0');
        $mau = isset($_GET['mau']) ? $_GET['mau'] : $product[0]['mau_sac'];
        $dung_luong = isset($_GET['dung_luong']) ? $_GET['dung_luong'] : $product[0]['dung_luong'];
        $color = $this->_products->getAttribute('mau_sac', 'name', $name);
        $data = $this->_products->getAttribute('dung_luong', 'name', $name);
        $offer = $this->_products->getData('', '', '', 'category_id', $cat);
        $total = $this->_feedback->countFeedback($name);
        sort($data);
        if (isset($_GET['dung_luong'])) {
            $dung_luong = substr($dung_luong, 0, -2);
        }
        $product_attr = $this->_products->getDetailProduct($name, $mau, $dung_luong);
        $support = $this->_attribute->getAttribute($id);
        if (!empty($product_attr)) {
            return $this->render('preview', ['product' => $product_attr, 'color' => $color, 'data' => $data, 'attribute' => $support, 'offer' => $offer, 'feedback' => $feedback, 'totalpage' => $total]);
        } else {
            return $this->header($this->_control, 'details', $id);
        }

    }


    function searchPro()
    {
        if (!isset($_GET['pages'])) {
            $key = $this->_valued->getParam('key', 'notnull');
            if ($key == false) {
                $this->header('', '', '');
            }
            $_SESSION['key'] = $key;
            $pages = $this->pages('pages');
            $offset = $this->offset($pages);
            $totalpage = $this->_products->countSearchProduct($key);
            $totalpage = $this->totalPage($totalpage);
            $products = $this->_products->searchProduct(ord, $key, limit, $offset);
            $category = $this->_category->getData('', '', '', '', '');
            if (empty($products)) {
                $this->header('', '', '');
            }
            return $this->render('products', ['category' => $category, 'products' => $products, 'totalpage' => $totalpage, 'offset' => $offset, 'pages' => $pages]);

        }
        if ($_GET["action"] == "searchPro" && isset($_GET['pages'])) {
            $key = isset($_SESSION['key']) ? $_SESSION['key'] : "";
            $pages = $this->pages('pages');
            $offset = $this->offset($pages);
            $totalpage = $this->_products->countSearchProduct($key);
            $totalpage = $this->totalPage($totalpage);
            $products = $this->_products->searchProduct(ord, $key, limit, $offset);
            $category = $this->_category->getData('', '', '', '', '');
            if (empty($products)) {
                $this->header('', '', '');
            }
            return $this->render('products', ['category' => $category, 'products' => $products, 'totalpage' => $totalpage, 'offset' => $offset, 'pages' => $pages]);
        }
        return $this->header('', '', '');

    }

    function searchPrice()
    {
        $id = $this->_valued->getParam('catid', 'notnull');
        if ($id == false) {
            $this->header($this->_control, '', '');
        }
        $id = (int)$id;
        //$id = substr($id, 0, 1);
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
        $pages = $this->pages('pages');
        $offset = $this->offset($pages);
        $totalpage = $this->_products->countProductPrice($price1, $price2);
        $totalpage = $this->totalpage($totalpage);
        $products = $this->_products->getProductPrice(ord, $price1, $price2, limit, $offset);
        $category = $this->_category->getData('', '', '', '', '');
        return $this->render('products', ['category' => $category, 'products' => $products, 'totalpage' => $totalpage, 'pages' => $pages]);

    }


    /*

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
    */

}

?>
