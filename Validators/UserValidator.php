<?php

namespace Validators;
class UserValidator extends BaseValidator
{
    public function validateLogin($params)
    {
        if (array_get($params, 'password') == '') {
           $this->addErrors('password_require','Ban phai nhap password');
        }
        if (array_get($params, 'username') == '') {
            $this->addErrors('username_require','Ban phai nhap username');
        }
        return $this->isValid();
    }


}