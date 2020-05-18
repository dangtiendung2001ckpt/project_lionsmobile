<?php


namespace Models;


class Category extends BaseModel
{
    protected $_tableName = 'category';
    protected $_fillAble = ['category_id', 'category_name'];
    protected $_primaryKey = 'category_id';

    public function getCategory(){
        $sql = "SELECT DISTINCT cat.category_id,cat.category_name FROM $this->_tableName as cat join product as pro on cat.$this->_primaryKey = pro.$this->_primaryKey ";
        $this->execute($sql);
        $count = $this->numRows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
}