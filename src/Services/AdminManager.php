<?php

namespace App\Services;

use App\lib\SessionManager;

class AdminManager
{
    private SessionManager $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }
    public function isAdmin()
    {
        if ($this->session->getSession('ROLE') === 'admin') {
            return true;
        }
    }
}
