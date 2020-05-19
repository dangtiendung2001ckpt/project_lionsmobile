<?php

namespace Models;
class BaseModel
{
    protected $_conn;
    protected $_result;
    protected $_tableName;
    protected $_fillAble;
    protected $_primaryKey;

    protected function dbConnect()
    {
        $this->_conn = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->_conn->connect_error) {
            $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
        }
        $this->_conn->set_charset(CHARSET);
    }

    protected function execute($sql)
    {
        $this->dbConnect();
        $this->_result = $this->_conn->query($sql);
        return $this->_result;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->_tableName where $this->_primaryKey = '$id'";
        return $this->execute($sql);
    }

    public function insert($data = [])
    {
        if (empty($data)) {
            return false;
        }
        $sql = "INSERT INTO $this->_tableName(";
        foreach ($data as $key => $item) {
            if (in_array($key, $this->_fillAble)) {
                $columns[] = $key;
                $values[] = '"' . $item . '"';
            }
        }

        $sql .= implode(',', $columns) . ')' . "VALUES(" . implode(',', $values) . ')';
        return $this->execute($sql);

    }

    public function update($data = [], $id)
    {
        if (empty($data) || empty($id)) {
            return false;
        }
        $sql = "UPDATE $this->_tableName SET ";
        foreach ($data as $key => $item) {
            if (in_array($key, $this->_fillAble)) {
                $columns[] = $key . '=';
                $columns[] = "'" . $item . "'" . ',';
            }
        }

        $sql .= substr(implode('', $columns), '0', '-1');
        $sql .= " where $this->_primaryKey = $id";
        return $this->execute($sql);
    }

    public function getRow()
    {
        $row = mysqli_fetch_array($this->_result);
        return $row;
    }

    public function numRows(){
        if (!$this->_result) {
            return 0;
        }
        return $this->_result->num_rows;
    }

    public function getData($ord,$limit,$offset){
        $sql = "SELECT * FROM $this->_tableName ORDER BY $this->_primaryKey $ord LIMIT $limit OFFSET $offset";
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

    public function getValue($id){
        $sql = "SELECT * FROM $this->_tableName where $this->_primaryKey = '$id' ";
        $this->execute($sql);
        $count = $this->numRows();
        $rows=[];
        if((int)$count > 0) {
            $rows= $this->getRow();
        }
        return $rows;
    }

    public function numRow($name,$value){
        $sql ="SELECT * FROM $this->_tableName where $name = '$value' ";
        $this->execute($sql);
        return $this->_result->num_rows;
    }

    public function getAllData(){
        $sql = "SELECT * FROM $this->_tableName ";
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

    public function getAllId($name,$key){
        $sql = "SELECT * FROM $this->_tableName where $name = '$key'";
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

?>