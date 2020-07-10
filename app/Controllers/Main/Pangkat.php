<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class Pangkat extends BaseController
{

    public function index()
    {
        parent::masterView('pangkat/pangkat', []);
    }

    public function tambah()
    {
        parent::masterView('pangkat/tambah', []);
    }
}