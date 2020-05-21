<?php


namespace Controllers\Backend;


use Controllers\BaseController;
use Models\Admin;
use Models\BaseModel;
use Models\Product;
use Validators\UserValidator;

class Login extends BaseController
{
    protected $_module = 'backend';
    protected $_adminValidators;
    protected $_admin;

    function __construct()
    {
        $this->_adminValidators = new UserValidator();
        $this->_admin = new Admin();

    }

    public function homes()
    {
        include_once 'views/' . $this->_module . '/login.php';
    }

    public function login()
    {
        if (!$this->_adminValidators->validateLogin($this->getParams())) {
            setFlashError($this->_adminValidators->getErrors());
            $this->render(redirect(url([])));
        }
        $name = array_get($this->getParams(), 'username');
        $password = array_get($this->getParams(), 'password');
        if ((int)$this->_admin->count(['name' => $name, 'password' => $password]) == 0) {
            $this->_adminValidators->addErrors('error', 'Tai khoan mat khau khong chinh xac');
            setFlashError($this->_adminValidators->getErrors());
            return redirect(url([]));
        }
        setFlashSession('admin', $name);
        return redirect(url([
            'control' => 'home',
            'action' => ''
        ]));
    }
    public function logout(){
        unsetSession('admin');
        return $this->homes();
    }

}