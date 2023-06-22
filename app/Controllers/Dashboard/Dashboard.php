<?php

namespace App\Controllers\Dashboard;
    
use CodeIgniter\Controller;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('dashboard/index');
    }
}
