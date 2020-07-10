<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\ModelJabatan;
use App\Models\ModelPangkat;
use App\Models\ModelPegawai;

class Pegawai extends BaseController
{
    public function index()
    {
        parent::masterView('pegawai/pegawai', []);
    }

    public function tambah()
    {
        parent::masterView('pegawai/tambah', []);
    }

    public function detailMutasi($id_pegawai)
    {
        $id_pegawai = array('id_pegawai' => $id_pegawai);
        // json_encode($id_pegawai);
        parent::masterView('pegawai/detailMutasi', []);
    }

    public function detailSKP()
    {
        parent::masterView('pegawai/detailSKP', []);
    }
}