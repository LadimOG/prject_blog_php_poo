<?php

namespace App\Services;


use App\Models\UserModel;
use App\Exceptions\ExceptionInput;

class UserService
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function log($email, $password)
    {
        $this->validateInput($email, $password);
        $user = $this->verifyUserExist($email, $password);
        return $user;
    }

    private function verifyUserExist($email, $password)
    {
        $user = $this->userModel->getUserByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            throw new ExceptionInput('Le mot de passe ou email incorrect');
        }
        return $user;
    }

    private function validateInput($email, $password)
    {
        if (empty($email) || empty($password)) {
            throw new ExceptionInput("Tous les champs sont obligatoires");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ExceptionInput('Votre adresse email n\'est pas valide!');
        }

        return true;
    }
}
