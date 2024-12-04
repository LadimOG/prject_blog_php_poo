<?php

namespace App\Services;

use App\Models\CommentModel;
use App\Exceptions\Exception404;
use App\Exceptions\ExceptionComment;

class CommentService
{

    private CommentModel $commentModel;


    public function __construct(CommentModel $commentModel)
    {
        $this->commentModel = $commentModel;
    }


    public function add($comment, $userId, $postId)
    {
        $this->validateInput($comment);

        $success = $this->commentModel->editComment($comment, $userId, $postId);

        if ($success < 0) {
            throw new ExceptionComment('Un problème est survenu lors de l\'ajout du commentaire');
        }
    }

    public function getCommentsById($id)
    {

        $comments =  $this->commentModel->getComments($id);
        if (!$comments) {
            throw new Exception404('Il semble que la page que vous avez demandée soit introuvable. Essayez de revenir à la page d\'accueil ou vérifiez l\'URL.');
        }
        return $comments;
    }

    public function getCommentById($id)
    {
        $comment = $this->commentModel->getComment($id);
        if (!$comment) {
            throw new Exception404('Il semble que la page que vous avez demandée soit introuvable. Essayez de revenir à la page d\'accueil ou vérifiez l\'URL.');
        }
        return $comment;
    }

    public function update($comment, $id)
    {
        $success = $this->commentModel->updateComment($comment, $id);

        if (!$success) {
            throw new Exception404('Il semble que la page que vous avez demandée soit introuvable. Essayez de revenir à la page d\'accueil ou vérifiez l\'URL.');
        }
        return $success;
    }

    public function delete($id)
    {

        $success = $this->commentModel->deletedComment($id);

        if (!$success) {
            throw new Exception404('Il semble que la page que vous avez demandée soit introuvable. Essayez de revenir à la page d\'accueil ou vérifiez l\'URL.');
        }
    }

    private function validateInput($comment)
    {
        if (empty($comment)) {
            throw new ExceptionComment('Veuillez saisir un commentaire !');
        }

        if (strlen($comment) < 5) {
            throw new ExceptionComment('Le commentaire droit contenir plus de 5 caractères');
        }

        return true;
    }
}
