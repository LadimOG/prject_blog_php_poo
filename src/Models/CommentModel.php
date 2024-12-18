<?php

namespace App\Models;


use App\lib\ConnectDb;
use PDO;

class CommentModel
{

    private ?PDO $pdo;


    public function __construct()
    {
        $this->pdo = ConnectDb::getConnect();
    }

    public function editComment($comment, $user_id, $post_id): bool
    {

        $sql = 'INSERT INTO comments (comment, user_id, post_id) VALUES(:comment , :user_id, :post_id)';

        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':comment' => $comment,
            ':user_id' => $user_id,
            ':post_id' => $post_id
        ]);

        return $query->rowCount() > 0;
    }

    public function getComments($id): array
    {
        $sql = 'SELECT c.*,u.firstname FROM comments AS c INNER JOIN users AS u ON c.user_id = u.id WHERE c.post_id = :id ORDER BY created_at DESC';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);

        $comments =  $query->fetchAll();

        return $comments ?? [];
    }

    public function getComment($id)
    {
        $sql = 'SELECT * FROM comments WHERE id_comment = :id';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);
        $comment = $query->fetch();

        return $comment;
    }

    public function updateComment($comment, $id): bool
    {

        $sql = 'UPDATE comments SET comment = :comment, created_at = NOW() WHERE id_comment = :id';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':comment' => $comment,
            ':id' => $id
        ]);

        return $query->rowCount() > 0;
    }

    public function deletedComment($id)
    {
        $sql = 'DELETE FROM comments WHERE id_comment = :id ';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);

        return $query->rowCount() > 0;
    }
}
