<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelPangkat;

class Pangkat extends BaseController
{
    public function index()
    {
        $mpangkat = new ModelPangkat();
        $data = $mpangkat->getPangkat();
        $output = [];
        foreach ($data as $key) {
            $idPangkat = $key->id_pangkat;
            $dataPangkat = $key->nama_pangkat . ' ' . $key->golongan . ' ' . $key->ruang;
            $output[] = array('id_pangkat' => $idPangkat, 'nama_pangkat' => $dataPangkat);
        }
        echo json_encode($output);
    }

    public function getDataPangkat()
    {
        $mpangkat = new ModelPangkat();
        echo json_encode($mpangkat->getPangkat());
    }

    public function insertData()
    {
        $model = new ModelPangkat();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        $dataJSON = $this->request->getJSON(true);
        if ($this->validator->run($dataJSON, 'pangkat')) {
            $model->insertData($dataJSON);
            $message = "Berhasil Menyimpan Data";
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function deletePangkat()
    {
        $model = new ModelPangkat();
        $where = $this->request->getJSON(true);
        $model->deletePangkat($where);
    }

    public function getDetailPangkat($where)
    {
        $model = new ModelPangkat();
        $where = array('id_pangkat' => $where);
        echo json_encode($model->detailPangkat($where));
    }

    public function updateData($where)
    {
        $model = new ModelPangkat();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        $dataJSON = $this->request->getJSON(true);
        if ($this->validator->run($dataJSON, 'pangkat')) {
            $where = array('id_pangkat' => $where);
            $model->editData($where, $dataJSON);
            $message = "Berhasil Mengubah Data";
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }
}