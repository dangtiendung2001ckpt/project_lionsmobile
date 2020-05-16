<?php
include_once 'connect.php';
class Count extends Database {



    public function num_row($table,$name,$username,$pass,$password){
        $sql = "SELECT * FROM $table where $name = '$username' and $pass ='$password' ";
        $this->execute($sql);
        return $this->result->num_rows;
    }




    public function row($table,$name,$username){
        $sql = "SELECT * FROM $table where $name = '$username'";
        $this->execute($sql);
        return $this->result->num_rows;
    }
    public function num_rowTable($table){
        $sql = "SELECT * FROM $table ";
        $this->execute($sql);
        return $this->result->num_rows;
    }
    public function num_row_search($value){
        $sql = "SELECT * FROM product where name REGEXP '$value' and defaults=1 ";
        $this->execute($sql);
        return $this->result->num_rows;
    }
    public function num_rowOrder($table,$id,$key,$name,$key2){
        $sql = "SELECT * FROM $table where $id ='$key' or $name='$key2'";
        $this->execute($sql);
        return $this->result->num_rows;
    }
    public function num_rowProPrice($price1,$price2){
        $sql = "SELECT * FROM product where price >= '$price1' and price <= '$price2' and defaults = 1 ";
        $this->execute($sql);
        return $this->result->num_rows;
    }


    public function num_rowFeedback($name){
        $sql = "SELECT user.user_name ,feedback.content,feedback.product_id ,product.name FROM feedback
                    join user on feedback.user_id = user.user_id 
                    join product on product.product_id = feedback.product_id
                    where feedback.defaults=1 and product.name ='$name' ";
        $this->execute($sql);
        return $this->result->num_rows;
    }
    public function num_row_searchPro($value){
        $sql = "SELECT * FROM product where name REGEXP '$value'  ";
        $this->execute($sql);
        return $this->result->num_rows;
    }
}
?>