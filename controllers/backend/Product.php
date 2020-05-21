<?php


namespace Controllers\Backend;


use Controllers\BaseController;
use Models\Attribute;
use Models\Category;
use Validators\ProductsValidator;

class Product extends BaseController
{
    protected $_module = 'backend';
    protected $_productModel;
    protected $_category;
    protected $_attribute;
    protected $_productValidators;
    public function __construct()
    {
        $this->_productModel = new  \Models\Product();
        $this->_category = new Category();
        $this->_attribute = new Attribute();
        $this->_productValidators = new ProductsValidator();
    }

    public function homes(){
        $limit = limit;
        $pages = $this->pages('pages');
        $offset = $this->offset($pages);
        $total = $this->_productModel->count([]);
        $total = $this->totalPage($total);
        $products = $this->_productModel->getData(['ord'=>'desc','limit'=>$limit,'offset'=>$offset]);
       return $this->render('productlist',['products'=>$products,'pages'=>$pages,'totalpage'=>$total]);

    }
    public function viewAddNew(){
        $category = $this->_category->getData([]);
        $attribute = $this->_attribute->getData([]);
        $this->render('productadd',['product'=>'','category'=>$category,'attribute'=>$attribute]);
    }
    public function addNew(){
        if (!$this->_productValidators->validateProducts($this->getParams())){
            setFlashError($this->_productValidators->getErrors());
           return redirect(url([
               'control'=>'product',
               'action'=>'viewAddNew'
           ]));
        }
        
    }

}