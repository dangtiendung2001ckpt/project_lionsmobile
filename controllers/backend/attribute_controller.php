<?php
include_once 'category_controller.php';
class AttributeController extends CategoryController {
    protected $_module='backend';
    protected $_control='attribute';
    public function homes()
    {
        return $this->homesView('attribute','attribute_id','ASC','attribute','attributelist','attribute');
    }

    public function viewAddAttribute(){
        return $this->addnewView('attribute','attribute_id','attributeaddnew');
    }

    function addnewAtribute(){
        return $this->addcat($_POST['attribute'],'attribute','attribute_name','attribute_id','viewAddAttribute');
    }

    public function updateAttribute(){
        return $this->update($_POST['attribute'],'attribute','attribute_name','attribute_id','viewAddAttribute');
    }
    public function delattribute(){
        if (isset($_SESSION['admin']) && isset($_GET['id']) && $_GET['id'] != ""){
            $id=$_GET['id'];
            $num = $this->row('detail_product','attribute_id',$id);
            if ($num > 0){
                $this->delete('detail_product','attribute_id',$id);
            }
            $this->delete('attribute','attribute_id',$id);
            header("location:index.php?module=$this->_module&control=attribute");
        }else{
            header("location:index.php?module=$this->_module&control=login");
        }
    }
}
?>
