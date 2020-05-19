<?php


namespace Models;


class Attribute extends Delete
{
    protected $_tableName = 'attribute';
    protected $_primaryKey = 'attribute_id';
    protected $_fillAble = ['attribute_id', 'attribute_name'];

    public function getAttribute($id){
        $sql="SELECT attribute_name FROM detail_product as detail join $this->_tableName as attr on attr.attribute_id = detail.attribute_id where product_id = '$id'";
        $this->execute($sql);
        $count = $this->numRows();
        $rows=[];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
}