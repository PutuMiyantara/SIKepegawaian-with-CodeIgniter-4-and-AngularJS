<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class Jabatan extends BaseController
{

    public function index()
    {
        parent::masterView('jabatan/jabatan', []);
    }

    public function tambah()
    {
        parent::masterView('jabatan/tambah', []);
    }
}