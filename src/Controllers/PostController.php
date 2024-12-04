<?php

namespace App\Controllers;

use App\Exceptions\Exception404;
use App\lib\DateFormat;
use App\lib\Redirect;
use App\lib\SessionManager;
use App\lib\View;
use App\Services\CommentService;
use App\Services\PostService;

class PostController
{

    private CommentService $commentService;
    private PostService $postService;
    private SessionManager $session;


    public function __construct(CommentService $commentService, PostService $postService, SessionManager $session)
    {
        $this->commentService = $commentService;
        $this->postService = $postService;
        $this->session = $session;
    }


    public function showPost($id)
    {

        try {
            $post = $this->postService->getPostsById($id);
            $comments =  $this->commentService->getCommentsById($id);

            $data = [
                'post' => $post,
                'comments' => $comments,
                'postDate' => DateFormat::dateSanitizer($post['created_at']),
                'isConnected' => $this->session->getSession('connected'),
                'userId' => $this->session->getSession('user_id'),
                'msgError' => $this->session->getSession('MSG_ERROR'),
                'commentSuccess' => $this->session->getSession('COMMENT_SUCCESS'),
            ];

            //ajouter des session pour la persistance des donners en cas de connexion
            $this->session->setSession('redirect', "/post/{$post['id']}");
            $this->session->setSession('POST_ID', $post['id']);

            //supprimer les message flash de success et error après l'affichage
            $this->session->unsetSession('COMMENT_SUCCESS');
            $this->session->unsetSession('MSG_ERROR');
            View::render('post/post.php', $data);
        } catch (Exception404 $e) {
            $this->session->setSession('MSG_ERROR_404', $e->getMessage());
            Redirect::to('/404');
        }
    }
}
