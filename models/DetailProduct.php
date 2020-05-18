<?php


namespace Models;


class DetailProduct extends BaseModel
{
    protected $_tableName = 'detail_product';
    protected $_primaryKey = 'product_id';
    protected $_fillAble = ['detail_product_id','product_id','attribute_id'];

    public function deleteAttribute($id)
    {
        $sql = "DELETE FROM $this->_tableName where attribute_id = '$id'";
        return $this->execute($sql);
    }
}