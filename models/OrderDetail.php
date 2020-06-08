<?php


namespace Models;


class OrderDetail extends Delete
{
    protected $_tableName = 'order_detail';
    protected $_primaryKey = 'order_detail_id';
    protected $_fillAble = ['order_detail_id', 'order_id', 'product_id', 'price', 'sl', 'trang_thai'];
}