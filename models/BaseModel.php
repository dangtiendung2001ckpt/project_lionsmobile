<?php

namespace Models;
class BaseModel
{
    protected $_conn;
    protected $_result;
    protected $_tableName;
    protected $_fillAble;
    protected $_primaryKey;
    public $errors = [];

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
        $error = mysqli_error($this->_conn);
        if(!empty($error)){
            throw new \Exception($error);

        }
        return $this->_result;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->_tableName where $this->_primaryKey = '$id'";
        $this->execute($sql);
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
        $sql .= implode(',', $columns) . ')' . " VALUES(" . implode(',', $values) . ')';
        $this->execute($sql);

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
        $this->execute($sql);
    }

    protected function _getRow()
    {
        $row = mysqli_fetch_array($this->_result);
        return $row;
    }

    protected function _numRows()
    {
        if (!$this->_result) {
            return 0;
        }
        return $this->_result->num_rows;
    }

    public function getData($data = [])
    {
        $sql = "SELECT * FROM $this->_tableName";
        foreach ($data as $key => $item) {
            if (in_array($key, $this->_fillAble)) {
                $columns[] = $key;
                $values[] = $item;
            }
        }
        if (isset($columns)) {
            $sql .= " WHERE $columns[0] = '$values[0]' ";
        }
        if (isset($columns[1])) {
            for ($i = 1; $i < count($columns); $i++) {
                $sql .= "AND $columns[$i] = '$values[$i]' ";
            }
        }
        if (array_key_exists('ord', $data)) {
            $data['ord'] = strtoupper($data['ord']);
            if ($data['ord'] == 'ASC' || $data['ord'] == 'DESC') {
                $sql .= " ORDER BY $this->_primaryKey " . $data['ord'];
            }
        }
        if (array_key_exists('limit', $data)) {
            $limit = (int)$data['limit'];
            $sql .= " LIMIT $limit ";
            if (array_key_exists('offset', $data)) {
                $offset = (int)$data['offset'];
                $sql .= "OFFSET $offset";

            }
        }
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


    public function count($data = [])
    {
        $sql = "SELECT * FROM $this->_tableName";
        foreach ($data as $key => $item) {
            if (in_array($key, $this->_fillAble)) {
                $columns[] = $key;
                $values[] = $item;
            }
        }
        if (isset($columns)) {
            $sql .= " WHERE $columns[0] = '$values[0]' ";
        }
        if (isset($columns[1])) {
            for ($i = 1; $i < count($columns); $i++) {
                $sql .= "AND $columns[$i] = '$values[$i]' ";
            }
        }
        $this->execute($sql);
        return $this->_result->num_rows;

    }
    public function startTRANSACTION(){
        $sql = "START TRANSACTION";
        $this->execute($sql);
    }
    public function commit(){
        $sql = "COMMIT";
        $this->execute($sql);
    }
    public function rollBack(){
        $sql = "ROLLBACK";
        $this->execute($sql);
    }
    /*
    public function handling($data=[]){
        foreach ($data as $key => $value ){
            $val[]= $value;
        }
        $sql=implode(';',$val);
        var_dump($sql);
        $this->execute($sql);
    }
    */

}

?>