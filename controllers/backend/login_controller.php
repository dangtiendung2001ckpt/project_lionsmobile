<?php
include_once 'Models/showdata.php';
class LoginController extends ShowData
{
    protected $_module = 'backend';
    public function login(){

        if ($_POST["username"]!= "" && $_POST["password"]!= "") {
            $table="admin";
            $name="name";
            $pass="password";
            $username=$_POST["username"];
            $password=$_POST["password"];
            $password=md5($password);
            if ($this->num_row($table,$name,$username,$pass,$password)>0) {
                $id =$this->getData('admin','name',$username);
                $_SESSION["admin_id"]=$id['ad_id'];
                $_SESSION["admin"]=$username;
                header("location:index.php?module=backend");
            }else{
                header("location:index.php?module=backend&control=login&str=2");
            }
        }else{
            header("location:index.php?module=backend&control=login&str=1");
        }
    }
    public function logout(){
        session_unset();
        header("location:index.php?module=backend&control=login");
    }
    function homes()
    {
        return $this->render('login');
    }
    public function render($file)
    {
        include_once 'views/' . $this->_module . '/' . $file . '.php';
    }

}
?>