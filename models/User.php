<?php


namespace Models;


class User extends Delete
{
    protected $_tableName = 'user';
    protected $_primaryKey = 'user_id';
    protected $_fillAble = ['user_id', 'user_name', 'password', 'phone', 'provincial', 'district', 'ward', 'address'];
}