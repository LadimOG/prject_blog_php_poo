<?php

namespace App\Controllers;

use App\lib\SessionManager;
use App\Services\AdminManager;

class AdminController
{
    private SessionManager $session;
    private AdminManager $adminManager;

    public function __construct(AdminManager $adminManager)
    {
        $this->adminManager = $adminManager;
    }

    public function showDashboard()
    {
        return $this->adminManager->isAdmin();
    }
}
