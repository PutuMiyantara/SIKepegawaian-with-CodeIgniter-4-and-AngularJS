<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Auth extends BaseController
{
    public function index()
    {
        echo view('templates/header');
        echo view('auth/login');
    }
}