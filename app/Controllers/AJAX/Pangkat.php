<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelPangkat;

class Pangkat extends BaseController
{
    public function index()
    {
        $mpangkat = new ModelPangkat();
        echo json_encode($mpangkat->getPangkat());
    }

    public function insertData()
    {
        $model = new ModelPangkat();
        $data = json_decode(file_get_contents("php://input"));
        $namaPangkat = $data->nama_pangkat;
        $gaji = $data->gaji;
        $data = array(
            'nama_pangkat' => $namaPangkat,
            'gaji' => $gaji
        );
        $model->insertData($data);
    }

    public function deletePangkat()
    {
        $model = new ModelPangkat();
        $data = json_decode(file_get_contents("php://input"));
        $id_pangkat = $data->id_pangkat;
        $where = array('id_pangkat' => $id_pangkat);
        $model->deletePangkat($where);
    }

    public function detailPangkat()
    {
        $model = new ModelPangkat();
        $data = json_decode(file_get_contents("php://input"));
        $id_pangkat = $data->id_pangkat;
        $where = array('id_pangkat' => $id_pangkat);
        echo json_encode($model->detailPangkat($where));
    }

    public function editData()
    {
        $model = new ModelPangkat();
        $data = json_decode(file_get_contents("php://input"));
        $idPangkat = $data->id_pangkat;
        $namaPangkat = $data->nama_pangkat;
        $gaji = $data->gaji;
        $where = array('id_pangkat' => $idPangkat);
        $data = array('nama_pangkat' => $namaPangkat, 'gaji' => $gaji);
        $model->editData($where, $data);
    }
}