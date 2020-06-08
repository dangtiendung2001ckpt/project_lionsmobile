<?php


namespace Controllers;

class Valued
{

    public function getParam($key, $null)
    {
        if (array_key_exists($key, $_GET)) {
            $key = $_GET[$key];
            if ($null == "notnull") {
                if (empty($key)) {
                    return false;
                }
                return $key;
            }
            return $key;
        }
        return false;
    }

}