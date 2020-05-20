<?php


namespace Models;


class Product extends BaseModel
{
    protected $_tableName = 'product';
    protected $_primaryKey = 'product_id';
    protected $_fillAble = ['product_id', 'category_id', 'ad_id', 'name', 'so_luong', 'mau_sac', 'img', 'ram', 'dung_luong', 'price', 'man_hinh', 'he_dieu_hanh', 'cpu', 'dl_pin', 'camera_truoc', 'camera_sau', 'phukien', 'date', 'defaults'];


    public function getProductPrice($ord, $price1, $price2, $limit, $offset)
    {
        $sql = "SELECT * FROM $this->_tableName where price >= '$price1' and price <= '$price2' and defaults = 1 ORDER BY $this->_primaryKey $ord LIMIT $limit OFFSET $offset";
        $this->execute($sql);
        $count = $this->_numRows();
        $rows = [];
        if ((int)$count > 0) {
            while ($row = $this->_getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    public function countProductPrice($price1, $price2)
    {
        $sql = "SELECT * FROM $this->_tableName where price >= '$price1' and price <= '$price2' and defaults = 1 ";
        $this->execute($sql);
        return $this->_result->num_rows;
    }

    public function countSearchProduct($value)
    {
        $sql = "SELECT * FROM $this->_tableName where name REGEXP '$value' and defaults=1 ";
        $this->execute($sql);
        return $this->_result->num_rows;
    }

    public function searchProduct($ord, $key, $limit, $offset)
    {
        $sql = "SELECT * FROM $this->_tableName where name REGEXP '$key' and defaults=1 ORDER BY $this->_primaryKey $ord LIMIT $limit OFFSET $offset   ";
        $this->execute($sql);
        $count = $this->_numRows();
        $rows = [];
        if ((int)$count > 0) {
            while ($row = $this->_getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    public function getAttribute($attribute, $name, $value)
    {
        $sql = "SELECT DISTINCT $attribute  FROM $this->_tableName where $name = '$value' order by $attribute ASC";
        $this->execute($sql);
        $count = $this->_numRows();
        $rows = [];
        if ((int)$count > 0) {
            while ($row = $this->_getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }


    public function getDetailProduct($name,$color,$data){
        $sql = "SELECT pro.product_id,pro.category_id,pro.name,pro.so_luong,pro.mau_sac,pro.img,pro.ram,pro.dung_luong,pro.price,pro.man_hinh,pro.he_dieu_hanh,pro.cpu,pro.dl_pin,pro.camera_truoc,pro.camera_sau,pro.phukien,pro.defaults,cat.category_name
                FROM product as pro join category as cat on pro.category_id = cat.category_id
                where pro.name = '$name' and pro.mau_sac = '$color' and pro.dung_luong= '$data' ";
        $this->execute($sql);
        $count = $this->_numRows();
        $rows=[];
        if((int)$count > 0) {
            $rows= $this->_getRow();
        }
        return $rows;
    }
    /*
    public function getOffer($ord, $limit, $offset, $price, $id)
    {
        $sql = "SELECT  * FROM $this->_tableName where defaults='1' and price >='$price' or category_id ='$id' and defaults = '1' ORDER BY $this->_primaryKey $ord LIMIT $limit OFFSET $offset  ";
        $this->execute($sql);
        $count = $this->numRows();
        $rows = [];
        if ((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }


    */

}