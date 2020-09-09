<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Pesan extends BaseController
{
    public function index()
    {
        parent::masterView('pesan/pesan', []);
    }
}