<?php


namespace Models;


class Admin extends BaseModel
{
    protected $_primaryKey = 'ad_id';
    protected $_fillAble = ['ad_id', 'name', 'password'];
    protected $_tableName = 'admin';
}