<?php

namespace App\Controllers;


use App\lib\SessionManager;
use App\lib\View;

class Page404
{

    private SessionManager $session;

    public function __construct(SessionManager $session)
    {
        $this->session =  $session;
    }

    public function show404()
    {

        $this->session->unsetSession('MSG_ERROR_404');
        View::render('error/page404.php');
    }
}
