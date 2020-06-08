<?php
 include_once 'showdata.php';
class DeleteValue extends ShowData {
    public function delete($table,$id,$value){
        $sql = "DELETE FROM $table where $id = '$value'";
       return $this->execute($sql);
    }
}
?>
