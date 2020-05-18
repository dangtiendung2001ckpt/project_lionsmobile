<?php
include_once 'Models/delete.php';
class CategoryController extends DeleteValue {
    protected $_module = 'backend';
    protected $_control = 'category';
    public function homes(){
        return $this->homesView('category','category_id','ASC','category','catlist','category');
    }
    public function homesView($table,$table_id,$ord,$num_row_table,$file,$name)
    {
        $limit=10;
        $pages= isset($_GET['pages']) ? $_GET['pages'] : 1;
        $offset=($pages - 1) * $limit;
        $category=$this->getDatas($table,$table_id,$ord,$limit,$offset);
        $totalpage = $this->num_rowTable($num_row_table);
        $totalpage =ceil($totalpage / $limit);
        return $this->render($file,$totalpage,$offset,$pages,[$name=>$category]);
    }
    public function render($file,$totalpage,$offset,$pages,$data=[])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/sidebar.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }


    //
    public function addnew(){
        return $this->addnewView('category','category_id','catadd');
    }
    public function addnewView($table,$table_id,$file){
        $cat_id= isset($_GET['id']) ? $_GET['id'] : '';
        $category=[];
        if (isset($_GET['id'])){
            $category=$this->getData($table,$table_id,$cat_id);
        }
        return $this->render($file,'','','',$category);

    }


    //
    public function addnewcat(){
        return $this->addcat($_POST['cat'],'category','category_name','category_id','addnew');
    }
    public function addcat($cats,$table,$table_name,$table_id,$action){
        if (isset($_POST['submit']) && $cats !="" ){
            $cat=$cats;
            $cat= ucfirst($cat);
           if ($this->row($table,$table_name,$cat) == 0){
                $this->insertColumn($table,$table_id,$table_name,$cat);
               header("location:index.php?module=$this->_module&control=$this->_control&action=$action&suc=addnew");
           }else{
               header("location:index.php?module=$this->_module&control=$this->_control&action=$action&str=existcat");
           }

        }else{
            header("location:index.php?module=$this->_module&control=$this->_control&action=$action&str=null");
        }

    }


///
    public function updatecat(){
        return $this->update($_POST['cat'],'category','category_name','category_id','addnew');
    }
    public function update($cats,$table,$table_name,$table_id,$action){
        if (isset($_POST['submit']) && $cats != "" && isset($_GET['id']) && $_GET['id'] != "" ){
            $id=$_GET['id'];
            $cat=$cats;
            $cat= ucfirst($cat);
            if ($this->row($table,$table_name,$cat) == 0){
                $this->updateValue($table,$table_name,$cat,$table_id,$id);
                header("location:index.php?module=$this->_module&control=$this->_control&action=$action&suc=update");
            }else{
                header("location:index.php?module=$this->_module&control=$this->_control&action=$action&id=$id&str=nochange");
            }
        }else{
            header("location:index.php?module=$this->_module&control=$this->_control&action=$action&str=null");
        }
    }


    ///
    public function delcat(){
        return $this->del('category','category_id');
    }
    public function del($table,$table_id){
            if (isset($_SESSION['admin']) && isset($_GET['id']) && $_GET['id'] != ""){
               $id = $_GET['id'];
               $num=$this->row('product','category_id',$id);
               if ($num>0){
                   header("location:index.php?module=$this->_module&control=$this->_control&suc=nodel");
               }else{
                   $this->delete($table,$table_id,$id);
                   header("location:index.php?module=$this->_module&control=$this->_control&suc=del");
               }
            }else{
                header("location:index.php?module=$this->_module&control=login");
            }
    }

}
?>
