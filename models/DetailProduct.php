<?php


namespace Models;


class DetailProduct extends BaseModel
{
    protected $_tableName = 'detail_product';
    protected $_primaryKey = 'product_id';
    protected $_fillAble = ['detail_product_id','product_id','attribute_id'];
}