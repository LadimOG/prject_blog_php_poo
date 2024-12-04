<?php

namespace App\Controllers;

use App\lib\View;
use App\Models\PostModel;


class HomeController
{
    private PostModel $postModel;

    public function __construct(PostModel $postModel)
    {
        $this->postModel = $postModel;
    }


    public function index()
    {
        $posts = $this->postModel->getAllPost();
        View::render('home/home.php', $posts);
    }

    public function showAllpostWithCategories($category)
    {

        $posts = $this->postModel->getPostWhithCategory($category);
        View::render('post/layoutPost.php', $posts);
    }
}
