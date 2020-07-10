<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelJabatan;
use App\Models\ModelPangkat;
use App\Models\ModelPegawai;

class Jabatan extends BaseController
{
    public function index()
    {
        $model = new ModelJabatan();
        echo json_encode($model->getJabatan());
    }

    public function getDetailJabatan()
    {
        $model = new ModelJabatan();
        $data = json_decode(file_get_contents("php://input"));
        $id_jabatan = $data->id_jabatan;
        $id_jabatan = array('id_jabatan' => $id_jabatan);
        echo json_encode($model->getDetailJabatan($id_jabatan));
    }

    public function deleteJabatan()
    {
        $model = new ModelJabatan();
        $data = json_decode(file_get_contents("php://input"));
        $id_jabatan = $data->id_jabatan;
        $id_jabatan = array('id_jabatan' => $id_jabatan);
        $model->deleteJabatan($id_jabatan);
    }

    public function editData()
    {
        $model = new ModelJabatan();
        $data = json_decode(file_get_contents("php://input"));
        $id_jabatan = $data->id_jabatan;
        $nama_jabatan = $data->nama_jabatan;
        $where = array('id_jabatan' => $id_jabatan);
        $data = array('nama_jabatan' => $nama_jabatan);

        $model->editData($where, $data);
    }

    public function insertData()
    {
        $model = new ModelJabatan();
        $data = json_decode(file_get_contents("php://input"));
        $nama_jabatan = $data->nama_jabatan;
        $data = array('nama_jabatan' => $nama_jabatan);
        $model->insertData($data);
    }
}