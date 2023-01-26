<?php

class homeController extends Controller
{

    public function index()
    {
        $settings = $this->settings();
        $categories = $this->categories();
        $posts = $this->posts();
        $categoryImages = $this->categoryImages();
        $postImages = $this->postImages();

        $this->view('/home', $data = [
            'settings' => $settings,
            'categories' => $categories,
            'posts' => $posts,
            'categoryImages' => $categoryImages,
            'postImages' => $postImages
        ]);
    }

}

?>