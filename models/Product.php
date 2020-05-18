<?php


namespace Models;


class Product extends Delete
{
    protected $_tableName = 'product';
    protected $_primaryKey = 'product_id';
    protected $_fillAble = ['product_id', 'category_id', 'ad_id', 'name', 'so_luong', 'mau_sac', 'img', 'ram', 'dung_luong', 'price', 'man_hinh', 'he_dieu_hanh', 'cpu', 'dl_pin', 'camera_truoc', 'camera_sau', 'phukien', 'date', 'defaults'];

    public function getProduct($ord,$limit,$offset,$key,$value){
        $sql = "SELECT * FROM $this->_tableName where defaults = 1 and $key = '$value' ORDER BY $this->_primaryKey $ord LIMIT $limit OFFSET $offset";
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