<?php

namespace App\Controllers;

use App\Exceptions\Exception404;
use App\Exceptions\ExceptionComment;
use App\lib\Redirect;
use App\lib\Server;
use App\lib\SessionManager;
use App\lib\View;
use App\Services\CommentService;

class CommentController
{
    private string $comment;
    private string $userId;
    private string $postId;
    private SessionManager $session;
    private CommentService $commentService;

    public function __construct(SessionManager $session, CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->session = $session;
    }

    public function viewAddComment()
    {
        if (Server::requestGet()) {
            View::render('comment/addComment.php');
        }
    }

    public function addComment()
    {
        if (Server::requestPost()) {
            $this->comment = trim($_POST['comment']);
            $this->userId = $this->session->getSession('user_id');;
            $this->postId = $this->session->getSession('POST_ID');


            try {
                $this->commentService->add($this->comment, $this->userId, $this->postId);
                $this->session->setSession('COMMENT_SUCCESS', 'Votre commentaire a été ajouté avec success !');
                Redirect::to("/post/$this->postId");
            } catch (ExceptionComment $e) {
                $this->session->setSession('MSG_ERROR', $e->getMessage());
                Redirect::to("/post/$this->postId");
            }
        }
    }

    public function deleteComment($id)
    {
        if (Server::requestPost()) {
            try {
                $postId = (int)$this->session->getSession('POST_ID');
                $this->commentService->delete($id);
                $this->session->setSession('COMMENT_SUCCESS', 'Votre commentaire à bien été supprimé !');
                Redirect::to("/post/$postId");
            } catch (Exception404 $e) {
                $this->session->setSession('MSG_ERROR_404', $e->getMessage());
                Redirect::to("/404");
            }
        }
    }

    public function viewUpdateComment($id)
    {
        if (Server::requestGet()) {

            try {
                $comment = $this->commentService->getCommentById($id);
                View::render('comment/updateComment.php', ["comment" => $comment]);
            } catch (Exception404 $e) {
                $this->session->setSession('MSG_ERROR_404', $e->getMessage());
                Redirect::to('/404');
            }
        }
    }

    public function updateComment($id)
    {
        if (Server::requestPost()) {
            $this->comment = $_POST['comment'];

            try {
                $this->commentService->update($this->comment, $id);
                $this->session->setSession('COMMENT_SUCCESS', 'Votre commentaire à bien été modifié !');
                Redirect::to('/post/' . $this->session->getSession('POST_ID'));
            } catch (Exception404 $e) {
                Redirect::to('/404');
            }
        };
    }
}
