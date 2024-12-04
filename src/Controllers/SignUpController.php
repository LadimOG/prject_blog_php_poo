<?php

namespace App\Controllers;

use App\Exceptions\ExceptionInput;
use App\lib\Redirect;
use App\lib\Server;
use App\lib\Session;
use App\lib\SessionManager;
use App\lib\View;
use App\Services\RegisterUserService;

class SignUpController
{

    private string $firstname;
    private string $lastname;
    private int $age;
    private string $email;
    private string $password;
    private string $password2;

    private SessionManager $session;
    private RegisterUserService $registerService;

    public function __construct(SessionManager $session, RegisterUserService $registerService)
    {
        $this->registerService = $registerService;
        $this->session = $session;
    }

    public function pageSignUp()
    {
        View::render('login/sign_up.php');
    }


    public function signup()
    {

        if (Server::requestPost()) {
            $this->firstname = trim($_POST['firstname']);
            $this->lastname = trim($_POST['lastname']);
            $this->age = (int)trim($_POST['age']);
            $this->email = trim($_POST['email']);
            $this->password = trim($_POST['password']);
            $this->password2 = trim($_POST['password2']);

            try {
                $user = $this->registerService->register($this->firstname, $this->lastname,  $this->email, $this->password, $this->age, $this->password2);
                $this->session->setSession('user_email', $user['email']);
                $this->session->setSession('user_id', $user['id']);
                $this->session->setSession('user_name', $user['firstname']);
                $this->session->setSession('connected', true);
                Redirect::to('/');
            } catch (ExceptionInput $e) {
                $this->session->setSession('MSG_ERROR', $e->getMessage());
                Redirect::to('/signup');
            }
        }
    }
}
