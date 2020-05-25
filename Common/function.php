<?php
function getCurrentModule()
{
    return $GLOBALS['module'];
}

function getCurrentControl()
{
    return $GLOBALS['control'];
}

function getCurrentAction()
{
    return $GLOBALS['action'];
}

function pages($control, $action)
{
    $href = "index.php?module=backend&control=login";
    if (isset($_SESSION['admin'])) {
        $href = "index.php?module=backend&control=$control&action=$action";
    }
    return $href;
}


////
///
///


function url($array)
{
    $params = [
        'module' => array_get($array, 'module', getCurrentModule()),
        'control' => array_get($array, 'control', getCurrentControl()),
        'action' => array_get($array, 'action', ''),
    ];
    $params = array_merge($params, array_get($array, 'params', []));
    $url = "index.php?" . http_build_query($params);
    return $url;
}

function redirect($url)
{
   return header('location:' . $url);
}

function array_get($array, $key, $default = null)
{
    if (array_key_exists($key, $array)) {
        return $array[$key];
    }
    return $default;
}

function getFlashSession($key, $default = null)
{
    $result = array_get($_SESSION, $key, $default);
    unset($_SESSION[$key]);
    return $result;
}

function getFlashError()
{
    return getFlashSession('error', []);
}

function setFlashError($value)
{
    setFlashSession('error', $value);
}

function setFlashSession($key, $value)
{
    $_SESSION[$key] = $value;
}
function unsetSession($key){
    unset($_SESSION[$key]);
}
///
///
///
///
///
///
function actions($control, $action, $id)
{
    $href = "index.php?module=backend&control=login";
    if (isset($_SESSION['admin'])) {
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 1;
        $href = "index.php?module=backend&control=$control&action=$action&id=$id&page=$pages";
    }
    return $href;
}

function actionCart($control, $action, $id, $orderid)
{
    $href = "index.php?module=backend&control=login";
    if (isset($_SESSION['admin'])) {
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 1;
        $href = "index.php?module=backend&control=$control&action=$action&id=$id&orderid=$orderid&page=$pages";
    }
    return $href;
}


function convert()
{
    $str = "";
    if (isset($_GET['int'])) {
        switch ($_GET['int']) {
            case "1":
                $str = "Bạn cần nhập đầy đủ thông tin";
                break;
            case "2":
                $str = "Hai mật khẩu cần giống nhau";
                break;
            case "3":
                $str = "Tài khoản này đã tồn tại";
                break;
            case "null":
                $str = "Bạn chưa có tài khoản hãy đăng nhập hoặc đăng ký tài khoản mới";
                break;
            case "change":
                $str = "Bạn có muốn thay đổi địa chỉ giao hàng hay số điện thoại";
                break;
            case "address":
                $str = "Bạn cần nhập đủ số điện thoại và địa chỉ";
                break;

        }
    }
    return $str;
}

function replace()
{
    $str = "";
    if (isset($_GET['str'])) {
        switch ($_GET['str']) {
            case "1":
                $str = "Bạn chưa nhập  tài khoản mật khẩu";
                break;
            case "2":
                $str = "Tài khoản hoặc mật khẩu không chính xác";
                break;
            case "oldpass":
                $str = "Mật khẩu của bạn không đúng";
                break;
            case "repass":
                $str = "Hai mật khẩu mới cần giống nhau";
                break;
            case "null":
                $str = "Bạn cần nhập đầy đủ thông tin";
                break;
            case "newpass":
                $str = "Mật khẩu mới phải khác mật khẩu cũ";
                break;
            case "existcat":
                $str = "Danh mục đã tồn tại";
                break;
            case "nochange":
                $str = "Bạn cần nhập tên danh mục khác";
                break;
            case "img":
                $str = "Bạn Cần nhập File ảnh đúng";
                break;
        }
    }
    return $str;
}

function success()
{
    $str = "";
    if (isset($_GET['suc'])) {
        switch ($_GET['suc']) {
            case "addnew":
                $str = "Thêm mới thành công";
                break;
            case "update":
                $str = "Thay đổi thành công";
                break;
            case "nodel":
                $str = "Bạn không thể xóa bởi vì hãng này đã có sản phẩm";
                break;
            case "del":
                $str = "Xóa thành công";
                break;
            case "delpro":
                $str = "Không thể xóa sản phẩm này vì đã có khách hàng mua sản phẩm nên cần phải lưu trữ thông tin";
                break;
        }
    }
    return $str;
}

function checked($data, $name)
{
    if (!empty($data) && isset($data)) {
        return $data[0]["$name"];
    }
}

function addnewpro()
{
    if ($_GET['action'] == "quickAdd") {
        echo "readonly";
    }
}

function checkcart($name, $value)
{
    if (isset($name) && !empty($name)) {
        return $name[$value];
    }

}

function format_currency($n = 0)
{
    $n = (string)$n;
    $n = strrev($n);
    $res = "";
    for ($i = 0; $i < strlen($n); $i++) {
        if ($i % 3 == 0 && $i != 0) {
            $res .= ".";
        }
        $res .= $n[$i];
    }
    $res = strrev($res);
    return $res;
}

function revenue($key)
{
    $key = !empty($key) ? $key : 0;
    $key = format_currency($key);
    return $key;
}