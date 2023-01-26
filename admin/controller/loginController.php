<?php 

class loginController extends Controller
{
 
    public function index()
    {
        $this->view('login');
        
    }
    
    public function login()
    {

        $login_check = $this->model('loginmodel');
        $user = $login_check->login_check();

        if($user["login"]=="success"){
            session_start();
            $_SESSION['login']=true;
            $_SESSION['username']=$user['username'];
            $_SESSION['password']=$user['password'];

            header("Location:home");

        }elseif($user["login"]=="error"){
            echo "error";
        }
    }

}

?>