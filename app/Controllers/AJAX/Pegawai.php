<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Controllers\Main\Pegawai as MainPegawai;
// use App\Controllers\Pegawai as MainPegawai;
use App\Models\ModelJabatan;
use App\Models\ModelPangkat;
use App\Models\ModelPegawai;
use App\Models\ModelUser;

use function PHPSTORM_META\type;

class Pegawai extends BaseController
{
    // public function index()
    // {
    //     $model = new ModelPegawai();
    //     echo json_encode($model->getPegawais());
    // }
    public function index($role)
    {

        $model = new ModelPegawai();
        $role = array('role' => $role);
        if ($role['role'] == "3") {
            echo json_encode($model->getPegawais());
        } else {
            echo json_encode($model->getPegawai($role));
        }
    }

    public function insertData()
    {
        $model = new ModelPegawai();
        $modeluser = new ModelUser();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        $nama = array('nama' => $dataJSON['nama']);
        $whereuser = array('id_user' => $dataJSON['id_pegawai']);

        if ($this->lastRole() == 1) {
            if ($this->validator->run($dataJSON, 'textpns')) {
                array_pop($dataJSON);
                if ($model->insertData($dataJSON) && $modeluser->updateData($whereuser, $nama)) {
                    $message = "Berhasil Menyimpan Data";
                } else {
                    $errortext[] = "Gagal Menyimpan Data";
                }
            } else {
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        } else if ($this->lastRole() == 2) {
            if ($this->validator->run($dataJSON, 'textkontrak')) {
                $dataJSON['tgl_pensiun'] = null;
                array_pop($dataJSON);
                if ($model->insertData($dataJSON) && $modeluser->updateData($whereuser, $nama)) {
                    $message = "Berhasil Menyimpan Data";
                } else {
                    $errortext[] = "Gagal Menyimpan Data";
                }
            } else {
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function lastInsert()
    {
        $modeluser = new ModelUser();
        $data = $modeluser->getlast();
        if ($data) {
            echo json_encode($data);
        } else {
            $output = array('errortext' => 'Tidak Terdapat User Yang Dikaitkan');
            echo json_encode($output);
        }
    }

    public function lastRole()
    {
        $modeluser = new ModelUser();
        $data = $modeluser->getlast();
        return $data->role;
    }

    public function lastInsertRole()
    {
        $modeluser = new ModelUser();
        $data = $modeluser->getlast();
        echo json_encode($data);
    }

    public function getDetail($id_pegawai)
    {
        $modeldetail = new ModelPegawai();
        $where = array('id_pegawai' => $id_pegawai);
        echo json_encode($modeldetail->getPegawai($where));
    }

    public function updateData($id, $role)
    {
        $modelpegawai = new ModelPegawai();
        $modeluser = new ModelUser();
        $errortext[] = '';
        $message = '';
        $dataJSON = $this->request->getJSON(true);
        $wherepeg = array('id_pegawai' => $id);
        $whereuser = array('id_user' => $id);
        $nama = array('nama' => $dataJSON['nama']);
        if ($role == 1) {
            if ($this->validator->run($dataJSON, 'textpns')) {
                array_pop($dataJSON);
                $modelpegawai->updateData($wherepeg, $dataJSON);
                $modeluser->updateData($whereuser, $nama);
                $message = "Berhasil Menyimpan Data";
            } else {
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        } else if ($role == 2) {
            if ($this->validator->run($dataJSON, 'textkontrak')) {
                array_pop($dataJSON);
                $modelpegawai->updateData($wherepeg, $dataJSON);
                $modeluser->updateData($whereuser, $nama);
                $message = "Berhasil Menyimpan Data";
            } else {
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function deleteLastInsert()
    {
        $model = new ModelUser();
        $dataJSON = $this->request->getJSON(true);
        if ($dataJSON['role'] != '3') {
            $data = array('id_user' => $dataJSON['id_user']);
            if ($model->deleteLastInsert($data)) {
                unlink("./foto/" . $dataJSON['fotodelete']);
            }
        }
    }
}