<?php
include_once 'Models/update.php';
class AdminController extends Update
{
    protected $_module = 'backend';
    function homes()
    {
        return $this->render('adminadd');
    }
    public function render($file)
    {
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/sidebar.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }
    public function addnew(){
        if (isset($_POST['submit']) && $_POST['name'] !="" && $_POST['pass'] != "" && $_POST['repass'] !=""){
            $name=$_POST['name'];
            $pass=$_POST['pass'];
            $repass=$_POST['repass'];
            if ($pass==$repass){
                $pass=md5($pass);
                $num_row=$this->row('admin','name',$name);
                if ($num_row==0){
                    $this->insertValue('admin','ad_id','name',$name,'password',$pass);
                    header("location:index.php?module=$this->_module&control=admin&suc=addnew");
                }else{
                    header("location:index.php?module=$this->_module&control=admin&int=3");
                }
            }else{
                header("location:index.php?module=$this->_module&control=admin&int=2");
            }
        }else{
            header("location:index.php?module=$this->_module&control=admin&int=1");
        }
    }
    public function viewchangepass(){
        return $this->render('changepassword');
    }
    public function changepassword(){
        if(isset($_POST['submit']) && $_POST['passold'] !="" && $_POST['newpass'] !="" && $_POST['renewpass']){
            $name=$_SESSION['admin'];
            $oldpass=$_POST['passold'];
            $newpass=$_POST['newpass'];
            $renewpass=$_POST['renewpass'];
            if ($oldpass != $newpass){
                $oldpass=md5($oldpass);
                if ($newpass == $renewpass){
                    $now_row=$this->num_row('admin','name',$name,'password',$oldpass);
                    $newpass=md5($newpass);
                    if ($now_row !=0){
                        $this->updateValue('admin','password',$newpass,'name',$name);
                        header("location:index.php?module=$this->_module&control=admin&action=viewchangepass&suc=update");
                    }else{
                        header("location:index.php?module=$this->_module&control=admin&action=viewchangepass&str=oldpass");
                    }
                }else{
                    header("location:index.php?module=$this->_module&control=admin&action=viewchangepass&str=repass");
                }
            }else{
                header("location:index.php?module=$this->_module&control=admin&action=viewchangepass&str=newpass");
            }
        }else{
            header("location:index.php?module=$this->_module&control=admin&action=viewchangepass&str=null");
        }
    }
}
?>
