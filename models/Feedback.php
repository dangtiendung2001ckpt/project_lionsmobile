<?php


namespace Models;


class Feedback extends BaseModel
{
        protected $_tableName = 'feedback';
        protected $_primaryKey = 'feedback_id';
        protected $_fillAble = ['feedback_id','user_id','product_id','content','defaults'];

}