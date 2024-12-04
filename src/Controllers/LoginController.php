<?php

namespace App\Controllers;

use App\Exceptions\ExceptionInput;
use App\lib\Redirect;
use App\lib\Server;
use App\lib\SessionManager;
use App\lib\View;
use App\Services\UserService;

class LoginController
{
    private string $email;
    private string $password;

    private SessionManager $session;
    private UserService $userService;


    public function __construct(SessionManager $session, UserService $userService)
    {
        $this->userService = $userService;
        $this->session = $session;
    }
    public function pageLogin()
    {
        View::render('/login/sign_in.php');
    }

    public function login()
    {

        if (Server::requestPost()) {
            // Récupérer les données envoyées par le formulaire
            $this->email = trim($_POST['email']) ?? '';
            $this->password = trim($_POST['password']) ?? '';

            try {
                $user = $this->userService->log($this->email, $this->password);
                $this->session->setSession('user_id', $user['id']);
                $this->session->setSession('user_name', $user['firstname']);
                $this->session->setSession('connected', true);

                $redirected = $this->session->getSession('redirect');
                if ($redirected) {
                    Redirect::to($redirected);
                } else {
                    Redirect::to('/');
                }
            } catch (ExceptionInput $e) {
                $this->session->setSession('MSG_ERROR', $e->getMessage());
                Redirect::to('/login');
            }
        }
    }

    public function logout()
    {
        $this->session->destroySession();
        Redirect::to('/');
    }
}
