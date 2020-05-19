<?php

namespace Controllers\Frontend;

use Controllers\BaseController;
use Models\Provincial;

class User extends BaseController
{
    protected $_module = 'frontend';
    protected $_provincial;
    protected $_user;

    function __construct()
    {
        $this->_provincial = new Provincial();
        $this->_user = new \Models\User();
    }

    public function homes()
    {
        $provincial = $this->_provincial->getAllData();
        return $this->render('registration', ['provincial' => $provincial]);
    }

    function loginUser($username, $password)
    {
        if ($this->_user->countValue('user_name', $username, 'password', $password) == 0) {
            $_SESSION['error'] = "Tài khoản hoặc mật khẩu không đúng";
            return header("location:index.php?control=user");
        }
        $user = $this->_user->getValue($username);
        $_SESSION["user_id"] = $user['user_id'];
        $_SESSION["username"] = $user['user_name'];
        if (isset($_GET['proid']) && $_GET['proid'] != "") {
            $proid = $_GET['proid'];
            return header("location:index.php?control=products&action=details&id=$proid");
        } else {
            return header("location:index.php");
        }
    }


    public function login()
    {
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        if ($_POST["username"] == "" && $_POST["password"] == "") {
            $_SESSION['error'] = "Bạn chưa nhập tài khoản mật khẩu";
            return header("location:index.php?control=user&proid=$proid");
        }
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password = md5($password);
        return $this->loginUser($username, $password);

    }

    public function logout()
    {
        unset($_SESSION["user_id"]);
        unset($_SESSION["username"]);
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        header("location:index.php");
    }

    public function checkData()
    {
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        if (!isset($_POST["submit"]) && $_POST["username"] == "" && $_POST["pass"] == "" && $_POST["password"] == "" && $_POST["phone"] == "" && $_POST["provincial"] == "" && $_POST["district"] == "" && $_POST["ward"] == "" && $_POST["address"] == "") {
            $_SESSION['error_login'] = "Bạn cần nhập đầy đủ thông tin";
            return header("location:index.php?control=user&proid=$proid");
        }
        $username = $_POST["username"];
        $pass = $_POST["pass"];
        $repass = $_POST["password"];
        $phone = $_POST["phone"];
        $provincial = $_POST["provincial"];
        $district = $_POST["district"];
        $ward = $_POST["ward"];
        $address = $_POST["address"];
        $table = "user";
        $name = "user_name";
        $_SESSION['form_name'] = $username;
        $_SESSION['form_phone'] = $phone;
        $_SESSION['form_provincial'] = $provincial;
        $_SESSION['form_district'] = $district;
        $_SESSION['form_ward'] = $ward;
        $_SESSION['form_address'] = $address;
        if ($pass != $repass) {
            $_SESSION['error_login'] = "Hai mật khẩu không đúng";
            return header("location:index.php?control=user&proid=$proid");
        }
        $pass = md5($pass);
        $num_rows = $this->_user->numRow('user_name',$username);
        if ($num_rows > 0) {
            $_SESSION['error_login'] = "Tài khoản đã tồn tại";
            return header("location:index.php?control=user&proid=$proid");
        }
        $user = ['user_id' => null, 'user_name' => $username, 'password' => $pass, 'phone' => $phone, 'provincial' => $provincial, 'district' => $district, 'ward' => $ward, 'address' => $address];
        $this->_user->insert($user);
        unset($_SESSION['form_name']);
        unset($_SESSION['form_phone']);
        unset($_SESSION['form_provincial']);
        unset($_SESSION['form_district']);
        unset($_SESSION['form_ward']);
        unset($_SESSION['form_address']);
        $this->loginUser($username, $pass);


    }
}

?>