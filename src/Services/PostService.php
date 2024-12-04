<?php

namespace App\Services;


use App\Models\PostModel;
use App\Exceptions\Exception404;


class PostService
{

    private PostModel $postModel;

    public function __construct(PostModel $postModel)
    {
        $this->postModel = $postModel;
    }


    public function getPostsById($id)
    {
        $post = $this->postModel->getPost($id);
        if (!$post) {
            throw new Exception404('Il semble que le post que vous avez demandée soit introuvable. Essayez de revenir à la page d\'accueil ou vérifiez l\'URL.');
        }

        return $post;
    }
}
