<?php


namespace Models;


class Order extends Delete
{
    protected $_tableName = 'orders';
    protected $_primaryKey = 'order_id';
    protected $_fillAble = ['order_id', 'user_id', 'order_date'];
}