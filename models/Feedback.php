<?php


namespace Models;


class Feedback extends BaseModel
{
        protected $_tableName = 'feedback';
        protected $_primaryKey = 'feedback_id';
        protected $_fillAble = ['feedback_id','user_id','product_id','content','defaults'];

    public function countFeedback($name){
        $sql = "SELECT user.user_name ,feedback.content,feedback.product_id ,product.name FROM $this->_tableName
                    join user on feedback.user_id = user.user_id 
                    join product on product.product_id = feedback.product_id
                    where feedback.defaults=1 and product.name ='$name' ";
        $this->execute($sql);
        return $this->_result->num_rows;
    }

    public function getFeedback($ord,$name,$limit,$offset){
        $sql = "SELECT user.user_name ,feedback.content,feedback.product_id ,product.name FROM $this->_tableName
                    join user on feedback.user_id = user.user_id 
                    join product on product.product_id = feedback.product_id
                    where feedback.defaults=1 and product.name ='$name' order by feedback_id $ord LIMIT $limit OFFSET $offset  ";
        $this->execute($sql);
        $count = $this->_numRows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->_getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

}