<?php


namespace Models;


class Attribute extends Delete
{
    protected $_tableName = 'attribute';
    protected $_primaryKey = 'attribute_id';
    protected $_fillAble = ['attribute_id', 'attribute_name'];
}