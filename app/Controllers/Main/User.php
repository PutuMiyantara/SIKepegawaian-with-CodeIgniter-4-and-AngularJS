<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{

    public function index()
    {
        parent::masterView('user/user', []);
    }

    public function detail()
    {
        $this->masterView('/user/detail', []);
    }

    public function tambah()
    {
        $this->masterView('/user/tambah', []);
    }

    public function admin()
    {
        $this->masterView('templates/user/admin', []);
    }
    public function pegawai()
    {
        $this->masterView('templates/user/pegawai', []);
    }
}