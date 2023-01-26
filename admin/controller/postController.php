<?php
 
class postController extends Controller
{
  
    public function select_all()
    {
        $table = "posts";
        $column = "*";
        $condition = "WHERE status = ?";
        $data_types = "i";
        $post_datas = array("1");
        $postModel = $this->model('postModel');
        $posts = $postModel->select_all($post_datas,$data_types,$table,$column,$condition);

        $this->view('post/post-list', $data = [
            'posts' => $posts,
        ]);
    }

    public function insert()
    {
        if(isset($_POST['postAdd'])){
            $postModel = $this->model('postModel');
            $post_data = array_slice ($_POST,0, (count($_POST)-1));
            $table = "posts";
            $column = array();
            $post_data_values = array();
            $data_types = "iisssss";
            
            foreach($post_data as $key => $value) {
                $column[] = $key;
                $post_data_values[] = $value;
            }

            $post_data_values[3]= $this->make_link($post_data_values[2]); //We added the title to the empty incoming link input by making a link

            $post_insert = $postModel->insert($post_data_values,$data_types,$table,$column);

			if(!empty($_FILES['image']['name'][0])) {
				$file_name_number=count($_FILES['image']['name']);
				for($i=0; $i<$file_name_number; $i++){
					$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
					$filename = $_FILES["image"]["name"][$i];
					$filetype = $_FILES["image"]["type"][$i];
					$filesize = $_FILES["image"]["size"][$i];
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
							if(move_uploaded_file($_FILES["image"]["tmp_name"][$i], "../public/images/" . $imageName)){
                                $table = "post_images";
                                $column = array("status", "post_id", "cover", "image");
                                $post_data_values = array("1",$post_insert,"0",$imageName);
                                $data_types_images = "iiis";
                                $post_images_insert = $postModel->insert($post_data_values,$data_types_images,$table,$column);
							}
						}
					}
				}
			}
            
            if($post_insert!="fail"){
                $result = $post_insert;
                $post_id = $result;
                $table = "posts";
                $column = "*";
                $condition = "WHERE id = ? AND status = ?";
                $data_types = "ii";
                $post_datas = array($post_insert,"1");
                $post = $postModel->select($post_datas,$data_types,$table,$column,$condition);

                $table = "categories";
                $column = "*";
                $condition = "WHERE status = ?";
                $data_types = "i";
                $post_datas = array("1");
                $categoryModel = $this->model('categoryModel');
                $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);

                $this->view('post/post-edit', $data = [
                    'post' => $post,
                    'categories' => $categories,
                    'result' => 'success',
                ]);
            }else{
                $result = "fail";
                $table = "categories";
                $column = "*";
                $condition = "WHERE status = ?";
                $data_types = "i";
                $post_datas = array("1");
                $categoryModel = $this->model('categoryModel');
                $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);
                $this->view('post/post-add', $data = [
                    'categories' => $categories,
                    'result' => 'fail'
                ]);
            }
        }else{
            $table = "categories";
            $column = "*";
            $condition = "WHERE status = ?";
            $data_types = "i";
            $post_datas = array("1");
            $categoryModel = $this->model('categoryModel');
            $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);
            $this->view('post/post-add', $data = [
                'categories' => $categories,
            ]);
        }
    } 

    public function select($id)
    {
        $table = "posts";
        $column = "*";
        $condition = "WHERE id = ? AND status = ?";
        $data_types = "ii";
        $post_datas = array($id,"1");
        $postModel = $this->model('postModel');
        $post = $postModel->select($post_datas,$data_types,$table,$column,$condition);
        
        $table_images = "post_images";
        $column_images = "*";
        $condition_images = "WHERE post_id = ? AND status = ?";
        $data_types = "ii";
        $post_datas = array($id,"1");
        $post_images = $postModel->select_all($post_datas,$data_types,$table_images,$column_images,$condition_images);

        $table = "categories";
        $column = "*";
        $condition = "WHERE status = ?";
        $data_types = "i";
        $post_datas = array("1");
        $categoryModel = $this->model('categoryModel');
        $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);

        $this->view('post/post-edit', $data = [
            'post' => $post,
            'post_images' => $post_images,
            'categories' => $categories
        ]);
    }

    public function update($id)
    {

        $postModel = $this->model('postModel');

        if(isset($_POST['postUpdate'])){
            $post_data = array_slice ($_POST,0, (count($_POST)-1));
            $table = "posts";
            $column = array();
            $post_data_values = array();
            $condition = "WHERE id = ?";
            $data_types = "isssssi";
            
            foreach($post_data as $key => $value) {
                $column[] = $key . " = ?";
                $post_data_values[] = $value;
            }

            $post_data_values[2] = $this->make_link($post_data_values[1]); //We added the title to the empty incoming link input by making a link
            $post_data_values[] .= $id;

            $post_update = $postModel->update($post_data_values,$data_types,$table,$column,$condition);

            $result = $post_update;

            if(!empty($_FILES['image']['name'][0])) {
				$file_name_number=count($_FILES['image']['name']);
				for($i=0; $i<$file_name_number; $i++){
					$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
					$filename = $_FILES["image"]["name"][$i];
					$filetype = $_FILES["image"]["type"][$i];
					$filesize = $_FILES["image"]["size"][$i];
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
							if(move_uploaded_file($_FILES["image"]["tmp_name"][$i], "../public/images/" . $imageName)){
                                $table = "post_images";
                                $column = array("status", "post_id", "image", "cover");
                                $post_data_values = array("1",$id,$imageName,"0");
                                $data_types_images = "iisi";
                                $post_images_insert = $postModel->insert($post_data_values,$data_types_images,$table,$column);
                                // if($post_images_insert){
                                //     $result = "success";
                                // }else{
                                //     $result = "fail";
                                // }
							}
						}
					}
				}
			}

            $table = "posts";
            $column = "*";
            $condition = "WHERE id = ? AND status = ?";
            $data_types = "ii";
            $post_datas = array($id,"1");
            $post = $postModel->select($post_datas,$data_types,$table,$column,$condition);

            $table_images = "post_images";
            $column_images = "*";
            $condition_images = "WHERE post_id = ? AND status = ?";
            $data_types = "ii";
            $post_datas = array($id,"1");
            $post_images = $postModel->select_all($post_datas,$data_types,$table_images,$column_images,$condition_images);

            $table = "categories";
            $column = "*";
            $condition = "WHERE status = ?";
            $data_types = "i";
            $post_datas = array("1");
            $categoryModel = $this->model('categoryModel');
            $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);

            $this->view('post/post-edit', $data = [
                'post' => $post,
                'result' => $result,
                'post_images' => $post_images,
                'categories' => $categories
            ]);
        }

        if(isset($_POST['makeCover'])){
            $image_id = intval($_POST['makeCover']);

            $table_first = "post_images";
            $column_first = array("status = ?" , "cover = ?");
            $post_data_values_first = array("1","0","1",$id);
            $condition_first = "WHERE cover = ? AND post_id = ?";
            $data_types_first = "iiii";
            $post_image_update_first = $postModel->update($post_data_values_first,$data_types_first,$table_first,$column_first,$condition_first);
            //we reset each picture's cover status first

            $table = "post_images";
            $column = array("status = ?", "cover = ?");
            $post_data_values = array("1","1",$image_id);
            $condition = "WHERE id = ?";
            $data_types = "iii";
            $post_image_cover = $postModel->update($post_data_values,$data_types,$table,$column,$condition);
            $result = $post_image_cover;

            $table = "post_images";
            $column = "*";
            $condition = "WHERE id = ? AND status = ? AND cover = ?";
            $data_types = "iii";
            $post_datas = array($image_id,"1","1");
            $post_image_cover_select = $postModel->select($post_datas,$data_types,$table,$column,$condition);
            $make_post_cover_image = $post_image_cover_select['image'];

            $table = "posts";
            $column = array("status = ?", "cover_image = ?");
            $post_data_values = array("1",$make_post_cover_image,$id);
            $condition = "WHERE id = ?";
            $data_types = "isi";
            $post_update = $postModel->update($post_data_values,$data_types,$table,$column,$condition);

            $table = "posts";
            $column = "*";
            $condition = "WHERE id = ? AND status = ?";
            $data_types = "ii";
            $post_datas = array($id,"1");
            $post = $postModel->select($post_datas,$data_types,$table,$column,$condition);
            
            $table_images = "post_images";
            $column_images = "*";
            $condition_images = "WHERE post_id = ? AND status = ?";
            $data_types = "ii";
            $post_datas = array($id,"1");
            $post_images = $postModel->select_all($post_datas,$data_types,$table_images,$column_images,$condition_images);

            $table = "categories";
            $column = "*";
            $condition = "WHERE status = ?";
            $data_types = "i";
            $post_datas = array("1");
            $categoryModel = $this->model('categoryModel');
            $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);

            $this->view('post/post-edit', $data = [
                'post' => $post,
                'result' => $result,
                'post_images' => $post_images,
                'categories' => $categories
            ]);
        }

        if(isset($_POST['postDelete'])){
            $table = "posts";
            $column = "status = ?";
            $post_data_values = array("0",$id);
            $condition = "WHERE id = ?";
            $data_types = "ii";

            $post_delete = $postModel->delete($post_data_values,$data_types,$table,$column,$condition);
            
            $result = $post_delete;

            $table = "posts";
            $column = "*";
            $condition = "WHERE status = ?";
            $data_types = "i";
            $post_datas = array("1");
            $posts = $postModel->select_all($post_datas,$data_types,$table,$column,$condition);
    
            $this->view('post/post-list', $data = [
                'posts' => $posts,
                'result' => $result,
            ]);
        }

        if(isset($_POST['deleteImage'])){
            $image_id = intval($_POST['deleteImage']);
            $table = "post_images";
            $column = "status = ?";
            $post_data_values = array("0",$image_id);
            $condition = "WHERE id = ?";
            $data_types = "ii";

            $post_image_delete = $postModel->delete($post_data_values,$data_types,$table,$column,$condition);
            
            $result = $post_image_delete;

            $table = "posts";
            $column = "*";
            $condition = "WHERE id = ? AND status = ?";
            $data_types = "ii";
            $post_datas = array($id,"1");
            $post = $postModel->select($post_datas,$data_types,$table,$column,$condition);
            
            $table_images = "post_images";
            $column_images = "*";
            $condition_images = "WHERE post_id = ? AND status = ?";
            $data_types = "ii";
            $post_datas = array($id,"1");
            $post_images = $postModel->select_all($post_datas,$data_types,$table_images,$column_images,$condition_images);

            $table = "categories";
            $column = "*";
            $condition = "WHERE status = ?";
            $data_types = "i";
            $post_datas = array("1");
            $categoryModel = $this->model('categoryModel');
            $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);

            $this->view('post/post-edit', $data = [
                'post' => $post,
                'result' => $result,
                'post_images' => $post_images,
                'categories' => $categories
            ]);
        }
    }

 
}

?>