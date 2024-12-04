<?php

namespace App\Models;

use PDO;
use App\lib\ConnectDb;


class UserModel
{

    private ?PDO $pdo;


    public function __construct()
    {
        $this->pdo = ConnectDb::getConnect();
    }

    public function getUserByEmail($email): array
    {
        $sql = 'SELECT * FROM users WHERE email = :email';

        $query = $this->pdo->prepare($sql);
        $query->execute(
            [
                ':email' => $email
            ]
        );
        $user = $query->fetch();

        return $user !== false ? $user : [];
    }


    public function createNewUser($firstname, $lastname, $email, $password, $age): bool
    {
        $sql = "INSERT INTO users (firstname, lastname, email, password, age) VALUES(:firstname, :lastname, :email, :password, :age)";
        $query = $this->pdo->prepare($sql);
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
        $query->execute([
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email,
            ':password' => $hashPassword,
            ':age' => $age
        ]);

        return $query->rowCount() > 0;
    }
}
