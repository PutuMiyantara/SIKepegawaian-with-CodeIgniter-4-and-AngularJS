<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Mutasi extends BaseController
{
    public function index()
    {
        parent::masterView('mutasi/skmutasi', []);
    }

    public function detail($id_mutasi)
    {
        parent::masterView('mutasi/mutasi', []);
    }

    public function tambahSKMutasi()
    {
        parent::masterView('mutasi/tambahsk', []);
    }

    public function tambahMutasi()
    {
        parent::masterView('mutasi/tambah', []);
    }
}