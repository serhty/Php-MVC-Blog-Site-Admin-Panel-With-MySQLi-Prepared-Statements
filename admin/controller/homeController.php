<?php

class homeController extends Controller
{

    public function index()
    {

        $table = "categories";
        $column = "*";
        $condition = "WHERE status = ?";
        $data_types = "i";
        $post_datas = array("1");
        $categoryModel = $this->model('categoryModel');
        $categories = $categoryModel->select_all($post_datas,$data_types,$table,$column,$condition);

        $table = "posts";
        $column = "*";
        $condition = "WHERE status = ?";
        $data_types = "i";
        $post_datas = array("1");
        $postModel = $this->model('postModel');
        $posts = $postModel->select_all($post_datas,$data_types,$table,$column,$condition);

        $this->view('/home', $data = [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }

}

?>