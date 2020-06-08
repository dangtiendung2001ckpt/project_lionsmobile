<?php

class Addnew extends Count {
    public  function insertUser($name,$pass,$phone,$provincial,$district,$ward,$address){
        $sql = "INSERT INTO user(user_id,user_name, password, phone, provincial, district, ward, address) VALUES(null,'$name','$pass','$phone','$provincial','$district','$ward','$address')";
        return $this->execute($sql);

    }
    public function insertValue($table,$id,$name,$value_name,$pass,$value_pass){
        $sql = "INSERT INTO $table($id,$name,$pass) VALUES(null,'$value_name','$value_pass')";
        return $this->execute($sql);
    }
    public function insertColumn($table,$id,$name,$value_name){
        $sql = "INSERT INTO $table($id,$name) VALUES(null,'$value_name')";
        return $this->execute($sql);
    }
    public function insertProducts($category_id,$ad_id,$name,$so_luong,$mau_sac,$img,$ram,$dung_luong,$price,$man_hinh,$he_dieu_hanh,$cpu,$dl_pin,$camera_truoc,$camera_sau,$phukien,$date,$defaults){
        $sql = "INSERT INTO product(product_id, category_id , ad_id ,name,so_luong,mau_sac,img,ram,dung_luong,price,man_hinh,he_dieu_hanh,cpu,dl_pin,camera_truoc,camera_sau,phukien,date,defaults) 
            VALUES(null,'$category_id','$ad_id','$name','$so_luong','$mau_sac','$img','$ram','$dung_luong','$price','$man_hinh','$he_dieu_hanh','$cpu','$dl_pin','$camera_truoc','$camera_sau','$phukien','$date','$defaults')";
        return $this->execute($sql);
    }
    public function insertAuxiliary($table,$id,$column1,$column2,$column3,$column4,$value1,$value2,$value3,$value4){
        $sql = "INSERT INTO $table($id,$column1,$column2,$column3,$column4,trang_thai) VALUES(null,'$value1','$value2','$value3','$value4','chốt đơn')";
        return $this->execute($sql);
    }
    public function insertFeedback($value1,$value2,$value3,$value4){
        $sql = "INSERT INTO feedback(feedback_id,user_id,product_id,content,defaults) VALUES(null,'$value1','$value2','$value3','$value4')";
        return $this->execute($sql);
    }
}
