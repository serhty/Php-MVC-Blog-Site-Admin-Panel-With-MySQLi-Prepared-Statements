<?php 

class settingsModel extends Model
{

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
    
}

?>



