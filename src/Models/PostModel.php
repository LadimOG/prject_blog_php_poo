<?php

namespace App\Models;

use PDO;
use App\lib\ConnectDb;


class PostModel
{
    private ?PDO $pdo;

    public function __construct()
    {
        $this->pdo = ConnectDb::getConnect();
    }

    public function createPost() {}

    public function getAllPost(): array
    {

        $sql = 'SELECT * FROM  post ORDER BY created_at DESC';

        $query = $this->pdo->prepare($sql);
        $query->execute();
        $post = $query->fetchAll();

        return $post ?: [];
    }

    public function getPost($id): array
    {
        $sql = 'SELECT * FROM  post WHERE id = :id';

        $query = $this->pdo->prepare($sql);
        $query->execute(
            [
                ":id" => $id
            ]
        );

        $post = $query->fetch();


        return $post !== false ? $post : [];
    }

    public function getPostWhithCategory($cat): array
    {
        $sql = 'SELECT * FROM  post WHERE categories = :category';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':category' => $cat
        ]);

        $post = $query->fetchAll();

        return $post ?? [];
    }
}
