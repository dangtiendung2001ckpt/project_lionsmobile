<?php


namespace Models;


class Delete extends BaseModel
{
    public function deleteValue($table, $id, $value)
    {
        $sql = "DELETE FROM $table where $id = '$value'";
        return $this->execute($sql);
    }
}