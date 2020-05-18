<?php
include_once 'Models/showdata.php';
class User extends ShowData {
    protected $_module = 'frontend';
    public function homes()
    {
        $provincial = $this->getAllData('provincial');
        return $this->render('registration', ['provincial' => $provincial]);
    }
    public function render($file, $data = [])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }

    function loginUser($username,$password){
        if ($this->num_row('user','user_name',$username,'password',$password)>0) {
            $user = $this->getData('user','user_name',$username);
            $_SESSION["user_id"] = $user['user_id'];
            $_SESSION["username"]=$user['user_name'];
            if (isset($_GET['proid']) && $_GET['proid'] != ""){
                $proid=$_GET['proid'];
                header("location:index.php?control=products&action=details&id=$proid");
            }else{
                header("location:index.php");
            }
        }else{
            header("location:index.php?control=login&str=2");
        }
    }



    public function login(){
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        if ($_POST["username"]!= "" && $_POST["password"]!= "") {
            $username=$_POST["username"];
            $password=$_POST["password"];
            $password=md5($password);
            return $this->loginUser($username,$password);
        }else{
            header("location:index.php?control=login&str=1&proid=$proid");
        }
    }
    public function logout(){
        unset($_SESSION["user_id"]);
        unset($_SESSION["username"]);
        if (isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }
        header("location:index.php");
    }
    public function checkData(){
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        if (isset($_POST["submit"]) && $_POST["username"]!="" && $_POST["pass"]!="" && $_POST["password"]!="" && $_POST["phone"]!="" && $_POST["provincial"]!="" && $_POST["district"]!=""  && $_POST["ward"]!="" && $_POST["address"]!="") {
            $username=$_POST["username"];
            $pass=$_POST["pass"];
            $repass=$_POST["password"];
            $phone=$_POST["phone"];
            $provincial=$_POST["provincial"];
            $district=$_POST["district"];
            $ward=$_POST["ward"];
            $address=$_POST["address"];
            $table="user";
            $name="user_name";
            $_SESSION['form_name']= $username;
            $_SESSION['form_phone']= $phone;
            $_SESSION['form_provincial']= $provincial;
            $_SESSION['form_district']= $district;
            $_SESSION['form_ward']= $ward;
            $_SESSION['form_address']= $address;
            if($pass != $repass ){
                header("location:index.php?control=login&int=2&proid=$proid");
            }else{
                $pass=md5($pass);
                $num_rows=$this->row($table,$name,$username);
                if ($num_rows>0) {
                    header("location:index.php?control=login&int=3&proid=$proid");
                }else{
                    $this->insertUser($username, $pass, $phone, $provincial, $district,$ward, $address);
                    unset($_SESSION['form_name']);
                    unset($_SESSION['form_phone']);
                    unset($_SESSION['form_provincial']);
                    unset($_SESSION['form_district']);
                    unset($_SESSION['form_ward']);
                    unset($_SESSION['form_address']);
                    $this->loginUser($username,$pass);
                }
            }

        }else{
            header("location:index.php?control=login&int=1&proid=$proid");
        }

    }
}
?>