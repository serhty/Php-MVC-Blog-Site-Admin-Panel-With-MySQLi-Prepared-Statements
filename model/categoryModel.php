<?php 

class categoryModel extends Model
{

    public function select_all($post_datas,$data_types,$table, $column, $condition)
    {
        $con = new Database();
        $result = $con->select_all($post_datas,$data_types,$table, $column, $condition);
        return $result;
    }
     
    public function select($post_datas,$data_types,$table, $column, $condition)
    {
        $con = new Database();
        $result = $con->select($post_datas,$data_types,$table, $column, $condition);
        return $result;
    }

    public function update($post_data_values,$data_types,$table,$column,$id)
    {
        $con = new Database();
        $result = $con->update($post_data_values,$data_types,$table,$column,$id);
        return $result;
    }

    public function insert($post_data_values,$data_types,$table,$column)
    {
        $con = new Database();
        $result = $con->insert($post_data_values,$data_types,$table,$column);
        return $result;
    }

    public function delete($post_data_values,$data_types,$table,$column,$id)
    {
        $con = new Database();
        $result = $con->delete($post_data_values,$data_types,$table,$column,$id);
        return $result;
    }
    
}

?>



