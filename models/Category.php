<?php


namespace Models;


class Category extends BaseModel
{
    protected $_tableName = 'category';
    protected $_fillAble = ['category_id', 'category_name'];
    protected $_primaryKey = 'category_id';


}