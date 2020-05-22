<?php

namespace Validators;
class BaseValidator
{
    protected $_errors = [];

    public function getErrors()
    {
        return $this->_errors;
    }

    public function setErrors($value)
    {
        $this->_errors = $value;
        return $this;
    }

    public function isValid()
    {
        return empty($this->getErrors());
    }

    public function addErrors($key, $msg)
    {
        $this->_errors[$key] = $msg;
        return $this;
    }
}