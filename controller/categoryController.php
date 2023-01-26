<?php

class categoryController extends Controller
{   
    public function select($url)
    {
        $settings = $this->settings();
        $categories = $this->categories();
        $posts = $this->posts();
        $categoryImages = $this->categoryImages();
        $postImages = $this->postImages();

        $categoryModel = $GLOBALS['categoryModel'];

        $table = "categories";
        $column = "*";
        $condition = "WHERE link = ? AND status = ?";
        $data_types = "si";
        $post_datas = array($url,"1");
        $category = $categoryModel->select($post_datas,$data_types,$table,$column,$condition);

        $postModel = $GLOBALS['postModel'];

        $categoryId = $category['id'];
        $table = "posts";
        $column = "*";
        $condition = "WHERE category_id = ? AND status = ?";
        $data_types = "ii";
        $post_datas = array($categoryId,"1");
        $categoryPosts = $postModel->select_all($post_datas,$data_types,$table,$column,$condition);

        $this->view('/category', $data = [
            'settings' => $settings,
            'categories' => $categories,
            'posts' => $posts,
            'categoryImages' => $categoryImages,
            'postImages' => $postImages,
            'category' => $category,
            'categoryPosts' => $categoryPosts,
        ]);
    }
}

?>