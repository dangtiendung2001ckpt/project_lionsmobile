<?php
include_once 'addnew.php';
class Update extends Addnew {


    public function updateValue($table,$name,$value,$id,$id_value){
        $sql = "UPDATE $table SET $name = '$value'   where $id = '$id_value' ";
        return $this->execute($sql);
    }


    public function updateProducts($category_id,$ad_id,$name,$so_luong,$mau_sac,$img,$ram,$dung_luong,$price,$man_hinh,$he_dieu_hanh,$cpu,$dl_pin,$camera_truoc,$camera_sau,$phukien,$date,$defaults,$id){
        $sql = "UPDATE product SET category_id = '$category_id', ad_id='$ad_id' ,name= '$name', so_luong='$so_luong' ,mau_sac='$mau_sac' ,img='$img', ram='$ram' , dung_luong='$dung_luong' ,price='$price' ,man_hinh='$man_hinh', he_dieu_hanh='$he_dieu_hanh', cpu='$cpu', dl_pin='$dl_pin' ,camera_truoc='$camera_truoc' ,camera_sau='$camera_sau' ,phukien='$phukien' ,date='$date' ,defaults='$defaults' where product_id = '$id'  ";
        return $this->execute($sql);
    }
    public function updateUser($phone,$provincial,$district,$ward,$address,$id){
        $sql = "UPDATE user SET phone = '$phone', provincial= '$provincial',district='$district',ward='$ward',address='$address'  where user_id = '$id' ";
        return $this->execute($sql);
    }
}
