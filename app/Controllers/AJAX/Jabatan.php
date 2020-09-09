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

    public function getDetailJabatan($where)
    {
        $model = new ModelJabatan();
        $id_jabatan = array('id_jabatan' => $where);
        echo json_encode($model->getDetailJabatan($id_jabatan));
    }

    public function deleteJabatan()
    {
        $model = new ModelJabatan();
        $dataJSON = $this->request->getJSON(true);
        $model->deleteJabatan($dataJSON);
    }

    public function updateData($where)
    {
        $model = new ModelJabatan();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        if ($this->validator->run($dataJSON, 'jabatan')) {
            $where = array('id_jabatan' => $where);
            $model->editData($where, $dataJSON);
            $message = "Berhasil Menghubah Data";
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function insertData()
    {
        $model = new ModelJabatan();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        if ($this->validator->run($dataJSON, 'jabatan')) {
            $model->insertData($dataJSON);
            $message = "Berhasil Menyimpan Data";
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }
}