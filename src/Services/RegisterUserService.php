<?php

namespace App\Services;


use App\Models\UserModel;
use App\Exceptions\ExceptionInput;


class RegisterUserService
{

    private UserModel $userModel;


    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function register($firstname, $lastname,  $email, $password, $age, $password2)
    {
        $this->validateInput($firstname, $lastname, $email, $password, $age, $password2);
        $this->verifUserExist($email);
        $this->addNewUser($firstname, $lastname, $email, $password, $age);
    }


    public function validateInput($firstname, $lastname, $email, $password, $age, $password2)
    {
        //Vérification de tout les champs
        if (strlen($firstname) < 3 || strlen($lastname) < 3) {
            throw new ExceptionInput('Le nom ou prénom trop court!');
        }

        if ($age < 18) {
            throw new ExceptionInput('Vous devez avoir plus de 18 ans pour créer un compte!');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ExceptionInput('Votre adresse mail n\'est pas valide!');
        }

        if ($password !== $password2) {
            throw new ExceptionInput('Les mots de passe ne son pas identique');
        }

        if (strlen($password) < 8) {
            throw new ExceptionInput('Le mots de passe droit contenir plus de 8 caractères');
        }

        return true;
    }

    public function verifUserExist($email)
    {
        $user = $this->userModel->getUserByEmail($email);

        if ($user) {
            throw new ExceptionInput('Cette adresse email existe déja !');
        }
        return true;
    }

    public function addNewUser($firstname, $lastname, $email, $password, $age)
    {
        $success = $this->userModel->createNewUser($firstname, $lastname, $email, $password, $age);

        if (!$success) {
            throw new ExceptionInput('Un problème est survenue lors de la création du compte');
        }

        $user = $this->userModel->getUserByEmail($email);
        return $user;
    }
}
