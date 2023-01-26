<?php
 
class settingsController extends Controller
{

    public function select()
    {
        $table = "settings";
        $column = "*";
        $condition = "WHERE id = ?";
        $data_types = "i";
        $post_datas = array("1");
        $settingsModel = $this->model('settingsModel');
        $settings = $settingsModel->select($post_datas,$data_types,$table,$column,$condition);

        $this->view('settings', $data = [
            'settings' => $settings,
        ]);
    } 
    
    public function update()
    {
        $id = "1";

        if(isset($_POST['settingsUpdate'])){
            $settingsModel = $this->model('settingsmodel');
            $post_data = array_slice ($_POST,0, (count($_POST)-1));
            $table = "settings";
            $column = array();
            $post_data_values = array();
            $condition = "WHERE id = ?";
            if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
                $filename = $_FILES["image"]["name"];
                $filetype = $_FILES["image"]["type"];
                $filesize = $_FILES["image"]["size"];
                $str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
                $str_r = substr(str_shuffle($str), 0, 10);
                $imageName= $str_r."".str_replace("/",".",$filetype);
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
                $maxsize = 5 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: File size cannot be larger than 5MB.");
                if(in_array($filetype, $allowed)){
                    if(file_exists("../public/images/" . $imageName)){
                        echo $imageName . " already have.";
                    } else{
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], "../public/images/" . $imageName)){
                            $data_types = "sssssi";
                            foreach($post_data as $key => $value) {
                                $column[] = $key . " = ?";
                                $post_data_values[] = $value;
                            }
                            $column[] .= "logo = ?";
                            $post_data_values[] .= $imageName;
                            
                        }
                    }
                }
            }else{
                $data_types = "ssssi";
                foreach($post_data as $key => $value) {
                    $column[] = $key . " = ?";
                    $post_data_values[] = $value;
                }
            }

            $post_data_values[] .= $id;

            $setting_update = $settingsModel->update($post_data_values,$data_types,$table,$column,$condition);
            
            $result = $setting_update;

            $table = "settings";
            $column = "*";
            $condition = "WHERE id = ?";
            $data_types = "i";
            $post_datas = array("1");
            $settings = $settingsModel->select($post_datas,$data_types,$table,$column,$condition);
            $this->view('settings', $data = [
                'settings' => $settings,
                'result' => $result,
            ]);
        }
    }

}

?>