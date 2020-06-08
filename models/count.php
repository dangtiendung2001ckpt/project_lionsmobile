<?php


namespace Models;


class Count extends BaseModel
{
    protected $_tableName;
    public function countValue($column1,$value1,$column2,$value2){
        $sql = "SELECT * FROM $this->_tableName where $column1 = '$value1' and $column2 ='$value2' ";
        $this->execute($sql);
        return $this->_result->num_rows;
    }
}