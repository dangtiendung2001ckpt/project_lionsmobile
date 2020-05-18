<?php
namespace Models;

class ShowData extends Update
{

    //thực thi câu lệnh truy vấn

    //phương thức lấy dữ liệu
    public function getRow()
    {
        $row = mysqli_fetch_array($this->result);
        return $row;
    }


    ///đếm số lượng bản ghi
    public function num_rows(){
        if (!$this->result) {
            return 0;
        }
        return $this->result->num_rows;
    }


    ///phương thức lấy toàn bộ dữ liệu

    public function getAllData($table){
        $sql = "SELECT * FROM $table";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getAllPro($table,$name,$key){
        $sql = "SELECT * FROM $table where $name = '$key'";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getData($table,$id,$value){
        $sql = "SELECT * FROM $table where $id = '$value' ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows=[];
        if((int)$count > 0) {
            $rows= $this->getRow();
        }
        return $rows;
    }
    public function getDatas($table,$id,$ord,$limit,$offset){
        $sql = "SELECT * FROM $table ORDER BY $id $ord LIMIT $limit OFFSET $offset";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getProduct($id){
        $sql = "SELECT pro.product_id,pro.category_id,pro.name,pro.so_luong,pro.mau_sac,pro.img,pro.ram,pro.dung_luong,pro.price,pro.man_hinh,pro.he_dieu_hanh,pro.cpu,pro.dl_pin,pro.camera_truoc,pro.camera_sau,pro.phukien,pro.defaults,cat.category_name
                FROM product as pro join category as cat on pro.category_id = cat.category_id
                where pro.product_id = '$id'";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows=[];
        if((int)$count > 0) {
            $rows= $this->getRow();
        }
        return $rows;
    }
    public function getAttribute($id){
        $sql="SELECT attribute_name FROM detail_product as detail join attribute as attr on attr.attribute_id = detail.attribute_id where product_id = '$id'";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows=[];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getAllCategory(){
        $sql = "SELECT DISTINCT cat.category_id,cat.category_name FROM category as cat join product as pro on cat.category_id = pro.category_id ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getProductCat($category){
        $sql = "SELECT * FROM product as pro join category as cat on cat.category_id = pro.category_id  where category_name= '$category' AND defaults=1";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getAuxiliary($attribute,$name,$value){
        $sql = "SELECT DISTINCT $attribute  FROM product where $name = '$value' order by $attribute ASC";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    public function getProductAttr($name,$color,$data){
        $sql = "SELECT pro.product_id,pro.category_id,pro.name,pro.so_luong,pro.mau_sac,pro.img,pro.ram,pro.dung_luong,pro.price,pro.man_hinh,pro.he_dieu_hanh,pro.cpu,pro.dl_pin,pro.camera_truoc,pro.camera_sau,pro.phukien,pro.defaults,cat.category_name
                FROM product as pro join category as cat on pro.category_id = cat.category_id
                where pro.name = '$name' and pro.mau_sac = '$color' and pro.dung_luong= '$data' ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows=[];
        if((int)$count > 0) {
            $rows= $this->getRow();
        }
        return $rows;
    }
    public function searchProduct($value,$limit,$offset){
        $sql = "SELECT * FROM product where name REGEXP '$value' and defaults=1 ORDER BY product_id DESC LIMIT $limit OFFSET $offset   ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getSomeProduct($table,$id,$ord,$limit,$offset,$name,$key){
        $sql = "SELECT * FROM $table where $name ='$key' ORDER BY $id $ord LIMIT $limit OFFSET $offset  ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getOrders($limit,$offset,$key1,$kay2){
        $sql = "SELECT detail.order_detail_id,detail.order_id,detail.product_id,detail.price,detail.sl,od.order_date,us.user_name,us.phone,us.provincial,us.district,us.ward,us.address,pro.name,pro.mau_sac,pro.dung_luong,detail.trang_thai FROM order_detail as detail 
                        join orders as od on detail.order_id = od.order_id
                        join product as pro on pro.product_id = detail.product_id
                        join user as us on us.user_id = od.user_id 
                        WHERE detail.trang_thai='$key1' or  detail.trang_thai='$kay2'
                        ORDER BY order_detail_id DESC LIMIT $limit OFFSET $offset";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getCatProduct($table,$id,$ord,$limit,$offset,$name,$key,$cat,$value){
        $sql = "SELECT * FROM $table where $name ='$key' AND $cat ='$value' ORDER BY $id $ord LIMIT $limit OFFSET $offset  ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getOffer($table,$id,$ord,$limit,$offset,$name,$key,$cat,$value){
        $sql = "SELECT  * FROM $table where defaults='1' and $name >='$key' or $cat ='$value' and defaults = '1' ORDER BY $id $ord LIMIT $limit OFFSET $offset  ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    public function getStatistical($sum,$sum2,$date1,$date2,$dk,$dk1){
        $sql = "SELECT sum($sum),sum($sum2) FROM order_detail 
                 join orders on order_detail.order_id = orders.order_id 
                 join product on product.product_id = order_detail.product_id
                    WHERE order_date >= CAST('$date1' AS DATE) AND order_date <= CAST('$date2' AS DATE) AND trang_thai='đã thanh toán' and $dk ='$dk1' ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows=[];
        if((int)$count > 0) {
            $rows= $this->getRow();
        }
        return $rows;
    }


    public function getProPrice($price1,$price2,$limit,$offset){
        $sql = "SELECT * FROM product where price >= '$price1' and price <= '$price2' and defaults = 1 ORDER BY product_id  DESC LIMIT $limit OFFSET $offset";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    public function getFeedback($name,$limit,$offset){
        $sql = "SELECT user.user_name ,feedback.content,feedback.product_id ,product.name FROM feedback
                    join user on feedback.user_id = user.user_id 
                    join product on product.product_id = feedback.product_id
                    where feedback.defaults=1 and product.name ='$name' order by feedback_id DESC LIMIT $limit OFFSET $offset  ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }



    public function getallOrderUser($key1,$kay2,$id){
        $sql = "SELECT detail.order_detail_id,detail.order_id,detail.product_id,detail.price,detail.sl,od.order_date,us.user_name,us.phone,us.provincial,us.district,us.ward,us.address,pro.name,pro.mau_sac,pro.dung_luong,detail.trang_thai FROM order_detail as detail 
                        join orders as od on detail.order_id = od.order_id
                        join product as pro on pro.product_id = detail.product_id
                        join user as us on us.user_id = od.user_id 
                        WHERE detail.trang_thai='$key1' and od.user_id = '$id' or  detail.trang_thai='$kay2' and od.user_id = '$id'";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    public function searchProAdmin($value,$limit,$offset){
        $sql = "SELECT * FROM product where name REGEXP '$value' ORDER BY product_id DESC LIMIT $limit OFFSET $offset   ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }


    public function getChart($sum,$sum2,$date1,$date2,$dk1){
        $sql = "SELECT sum($sum),sum($sum2) FROM order_detail 
                 join orders on order_detail.order_id = orders.order_id 
                 join product on product.product_id = order_detail.product_id
                    WHERE order_date >= CAST('$date1' AS DATE) AND order_date <= CAST('$date2' AS DATE) AND trang_thai='đã thanh toán' and product.category_id ='$dk1' ";
        $this->execute($sql);
        $count = $this->num_rows();
        $rows=[];
        if((int)$count > 0) {
            $rows= $this->getRow();
        }
        return $rows;
    }
}
?>