<?php

namespace App\Controllers;

use App\lib\Redirect;
use App\lib\SessionManager;
use App\lib\View;
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
        if (!$this->adminManager->isAdmin()) {
            Redirect::to('/');
            return;
        }
    }
}
