<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Skp extends BaseController
{

    public function index()
    {
        parent::masterView('skp/skp', []);
    }

    public function detail()
    {
        $this->masterView('/user/detail', []);
    }

    public function tambah()
    {
        $this->masterView('/skp/tambah', []);
    }
}