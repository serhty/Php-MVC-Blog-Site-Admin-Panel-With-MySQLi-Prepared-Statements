<?php 

class loginModel extends Model
{

    public function login_check()
    {
        $username = $this->con->real_escape_string($_POST['username']);
		$password = $this->con->real_escape_string($_POST['password']);
        
        $query = "SELECT * FROM admins WHERE username = '$username' AND password = '$password' AND status='1'";

        $sql = $this->con->query($query);

        $result = mysqli_fetch_array($sql);

        if($result){
            $result += ['login' => "success"];
            return $result;
        }else{
            $result = ['login' => "error"];
            return $result;
        }
       

    }
    
}

?>