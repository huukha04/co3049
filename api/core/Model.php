<?php
trait Model {
    use Database;

    public $message = [];
    protected $allowedColumns = [];
    protected $allowedShows = [];
    protected $banned = [];
    protected $table = '';

    protected $limit = 10;
    protected $offset = 0;
    protected $order_column = "id";
    protected $order_type = "desc";





    public function insert($data) {
        
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(", ", $keys) . ") values (:" . implode(", :", $keys) . ")";
        $result = $this->PDOquery($query, $data);
        if ($result) {
            return true;
        }
        return false;
    }

    public function update($id, $data, $id_column = 'id') {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query, ", ");

        $query .= " WHERE $id_column = :$id_column ";

        $data[$id_column] = $id;
        $result = $this->PDOquery($query, $data);
        if ($result) {
            return true;
        }
        return false;
    }

    public function delete($id, $id_column = 'id') {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";

        $result = $this->PDOquery($query, $data);
        return $result !== false;
    }
    
    public function where($data, $data_not = []) {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data, $data_not);

        return $this->PDOquery($query, $data);
    }

    public function all() {
        $query = "SELECT * FROM $this->table";
        return $this->PDOquery($query);
    }

}