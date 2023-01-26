<?php

class postController extends Controller
{   
    public function select($url,$detail)
    {
        $settings = $this->settings();
        $categories = $this->categories();
        $posts = $this->posts();
        $categoryImages = $this->categoryImages();
        $postImages = $this->postImages();

        $postModel = $GLOBALS['postModel'];

        $table = "posts";
        $column = "*";
        $condition = "WHERE link = ? AND status = ?";
        $data_types = "si";
        $post_datas = array($detail,"1");
        $post = $postModel->select($post_datas,$data_types,$table,$column,$condition);

        $table = "posts";
        $column = "*";
        $condition = "WHERE link != ? AND status = ?";
        $data_types = "si";
        $post_datas = array($detail,"1");
        $otherPosts = $postModel->select_all($post_datas,$data_types,$table,$column,$condition);

        $this->view('/post', $data = [
            'settings' => $settings,
            'categories' => $categories,
            'posts' => $posts,
            'categoryImages' => $categoryImages,
            'postImages' => $postImages,
            'post' => $post,
            'otherPosts' => $otherPosts,
        ]);
    }
}

?>