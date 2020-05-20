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

    protected function _getRow()
    {
        $row = mysqli_fetch_array($this->_result);
        return $row;
    }

    protected function _numRows(){
        if (!$this->_result) {
            return 0;
        }
        return $this->_result->num_rows;
    }

    public function getData($ord,$limit,$offset,$columnName,$key){
        $sql = "SELECT * FROM $this->_tableName";
        if (!empty($key)){
            $sql.=" WHERE $columnName = '$key' ";
        }
        if (!empty($ord)){
            $sql.=" ORDER BY $this->_primaryKey $ord";
        }
        if (!empty($limit)){
            $sql.=" LIMIT $limit OFFSET $offset";
        }
        $this->execute($sql);
        $count = $this->_numRows();
        $rows = [];
        if((int)$count > 0) {
            while ($row = $this->_getRow()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }



    public function numRow($columnName,$key){
        $sql ="SELECT COUNT($this->_primaryKey) FROM $this->_tableName";
        if (!empty($key)){
            $sql.=" where $columnName = '$key'";
        }
        $this->execute($sql);
        $rows = [];
        $rows [] = $this->_getRow();
        return $rows[0]["COUNT($this->_primaryKey)"];

    }


}

?>