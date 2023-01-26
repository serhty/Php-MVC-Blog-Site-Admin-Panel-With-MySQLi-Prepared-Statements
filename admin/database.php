<?php

class Database {
 
    private $servername = "localhost";
    private $username 	= "root";
    private $password 	= "";
    private $database 	= "demo";
    public  $con;
    

    public function __construct()
    {
        $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
        $this->con->set_charset("utf8");
        if(mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
        }else{
            return $this->con;
        }
    }

    function select($post_datas,$data_types,$table,$column,$condition)
    {
        $result = [];
        $stmt = $this->con->prepare(" SELECT " . $column . " FROM " . $table . " ".$condition);
        $stmt->bind_param($data_types, ...$post_datas);
        $stmt->execute();
        $result_tables = $stmt->get_result();
        if ($result_tables->num_rows > 0) {
            while($row = $result_tables->fetch_assoc()) {
                $result[] = $row;
            }
            return $result[0];
        }else{
                
        }
    }
    
    function select_all($post_datas,$data_types,$table,$column,$condition)
    {
        $result = [];
        $stmt = $this->con->prepare(" SELECT " . $column . " FROM " . $table . " ".$condition);
        $stmt->bind_param($data_types, ...$post_datas);
        $stmt->execute();
        $result_tables = $stmt->get_result();
        if ($result_tables->num_rows > 0) {
            while($row = $result_tables->fetch_assoc()) {
                $result[] = $row;
            }
            return $result;
        }else{
                
        }
    }

    function update($post_datas,$data_types,$table,$column,$condition)
    {
        $stmt = $this->con->prepare("UPDATE " . $table . " SET " . join(",",$column) . " " . $condition);
        $stmt->bind_param($data_types, ...$post_datas);
        $stmt->execute();
        if(empty($stmt->error)) {
            $result = "success";
        } else {
            $result = "fail";
        }
        return $result;
        $stmt->close();
    }

    function insert($post_datas,$data_types,$table,$column)
    {
        $count_column = count($column);
        $columns_value = rtrim(str_repeat("?, ", $count_column),", ");
        $stmt = $this->con->prepare("INSERT INTO " . $table . " (" . join(",",$column) . ") VALUES (" . $columns_value . ")");
        $stmt->bind_param($data_types, ...$post_datas);
        $stmt->execute();
        if(empty($stmt->error)) {
            $result = $stmt->insert_id;
        } else {
            $result = "fail";
        }
        return $result;
        $stmt->close();
    }

    function delete($post_datas,$data_types,$table,$column,$condition)
    {
        $stmt = $this->con->prepare("UPDATE " . $table . " SET " . $column . " " . $condition);
        $stmt->bind_param($data_types, ...$post_datas);
        $stmt->execute();
        if(empty($stmt->error)) {
            $result = "success";
        } else {
            $result = "fail";
        }
        return $result;
        $stmt->close();
    }

}

?> 