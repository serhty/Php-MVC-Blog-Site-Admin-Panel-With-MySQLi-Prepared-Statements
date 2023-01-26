<?php
 
class categoryController extends Controller
{
  
    public function select_all()
    {
        $table = "categories";
        $column = "*";
        $condition = "WHERE status = ?";
        $data_types = "i";
        $post_datas = array("1");
        $categoryModel = $this->model('categoryModel');
        $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);

        $this->view('category/category-list', $data = [
            'categories' => $categories,
        ]);
    }

    public function insert()
    {
        if(isset($_POST['categoryAdd'])){
            $categoryModel = $this->model('categoryModel');
            $post_data = array_slice ($_POST,0, (count($_POST)-1));
            $table = "categories";
            $column = array();
            $post_data_values = array();
            $data_types = "isssss";
            
            foreach($post_data as $key => $value) {
                $column[] = $key;
                $post_data_values[] = $value;
            }

            $post_data_values[2]= $this->make_link($post_data_values[1]); // We added the title to the empty incoming link input by making a link

            $category_insert = $categoryModel->insert($post_data_values,$data_types,$table,$column);

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
                    }else{
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], "../public/images/" . $imageName)){
                            $table = "category_images";
                            $column = array("status", "category_id", "image", "cover");
                            $post_data_values = array("1",$category_insert,$imageName,"1");
                            $data_types_images = "iisi";
                            $category_images_insert = $categoryModel->insert($post_data_values,$data_types_images,$table,$column);
                        }
                    }
                }
			}
            
            if($category_insert!="fail"){
                $result = $category_insert;
                $category_id = $result;
                $table = "categories";
                $column = "*";
                $condition = "WHERE id = ? AND status = ?";
                $data_types = "ii";
                $post_datas = array($category_id,"1");
                $category = $categoryModel->select($post_datas,$data_types,$table,$column,$condition);
                $this->view('category/category-edit', $data = [
                    'category' => $category,
                    'result' => 'success',
                ]);
            }else{
                $result = "fail";
                $this->view('category/category-add', $data = [
                    'result' => 'fail'
                ]);
            }
        }else{
            $this->view('category/category-add');
        }
    } 

    public function select($id)
    {
        $table = "categories";
        $column = "*";
        $condition = "WHERE id = ? AND status = ?";
        $data_types = "ii";
        $post_datas = array($id,"1");
        $categoryModel = $this->model('categorymodel');
        $category = $categoryModel->select($post_datas,$data_types,$table,$column,$condition);
        
        $table_images = "category_images";
        $column_images = "*";
        $condition_images = "WHERE category_id = ? AND status = ?";
        $data_types = "ii";
        $post_datas = array($id,"1");
        $category_images = $categoryModel->select_all($post_datas,$data_types,$table_images,$column_images,$condition_images);

        $this->view('category/category-edit', $data = [
            'category' => $category,
            'category_images' => $category_images,
        ]);
    }

    public function update($id)
    {
        $categoryModel = $this->model('categoryModel');

        if(isset($_POST['categoryUpdate'])){
            $post_data = array_slice ($_POST,0, (count($_POST)-1));
            $table = "categories";
            $column = array();
            $post_data_values = array();
            $condition = "WHERE id = ?";
            $data_types = "sssssi";
            foreach($post_data as $key => $value) {
                $column[] = $key . " = ?";
                $post_data_values[] = $value;
            }

            $post_data_values[1] = $this->make_link($post_data_values[0]); //We added the title to the empty incoming link input by making a link
            $post_data_values[] .= $id;
            
            $category_update = $categoryModel->update($post_data_values,$data_types,$table,$column,$condition);

            $result = $category_update;

            $table = "categories";
            $column = "*";
            $condition = "WHERE id = ? AND status = ?";
            $data_types = "ii";
            $post_datas = array($id,"1");
            $category = $categoryModel->select($post_datas,$data_types,$table,$column,$condition);

            $table_images = "category_images";
            $column_images = "*";
            $condition_images = "WHERE category_id = ? AND status = ?";
            $data_types = "ii";
            $post_datas = array($id,"1");
            $category_images = $categoryModel->select_all($post_datas,$data_types,$table_images,$column_images,$condition_images);

            if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){

                $table_first = "category_images";
                $column_first = array("status = ?" , "cover = ?");
                $post_data_values_first = array("0","0","1",$id);
                $condition_first = "WHERE cover = ? AND category_id = ?";
                $data_types_first = "iiii";
                $category_image_update_first = $categoryModel->update($post_data_values_first,$data_types_first,$table_first,$column_first,$condition_first);

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
                    }else{
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], "../public/images/" . $imageName)){
                            $table = "category_images";
                            $column = array("status", "category_id", "image", "cover");
                            $post_data_values = array("1",$id,$imageName,"1");
                            $data_types_images = "iisi";
                            $category_images_insert = $categoryModel->insert($post_data_values,$data_types_images,$table,$column);
                        }
                    }
                }
            }

            $this->view('category/category-edit', $data = [
                'category' => $category,
                'result' => $result,
                'category_images' => $category_images
            ]);
        }

        if(isset($_POST['categoryDelete'])){
            $table = "categories";
            $column = "status = ?";
            $post_data_values = array("0",$id);
            $condition = "WHERE id = ?";
            $data_types = "ii";

            $category_delete = $categoryModel->delete($post_data_values,$data_types,$table,$column,$condition);
            
            $result = $category_delete;

            $table = "categories";
            $column = "*";
            $condition = "WHERE status = ?";
            $data_types = "i";
            $post_datas = array("1");
            $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);
    
            $this->view('category/category-list', $data = [
                'categories' => $categories,
                'result' => $result,
            ]);
        }
    }

 
}

?>