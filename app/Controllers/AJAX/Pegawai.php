<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Controllers\Main\Pegawai as MainPegawai;
// use App\Controllers\Pegawai as MainPegawai;
use App\Models\ModelJabatan;
use App\Models\ModelPangkat;
use App\Models\ModelPegawai;
use App\Models\ModelPesan;
use App\Models\ModelSKp;
use App\Models\ModelUser;

use function PHPSTORM_META\type;

class Pegawai extends BaseController
{
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
        $whereuser = array('id_user' => $dataJSON['id_pegawai']);

        if ($this->validator->run($dataJSON, 'textpns')) {
            $nama = array('nama' => $dataJSON['nama']);
            array_pop($dataJSON);
            if ($model->insertData($dataJSON) && $modeluser->updateData($whereuser, $nama)) {
                $message = "Berhasil Menyimpan Data";
            } else {
                $errortext[] = "Gagal Menyimpan Data";
            }
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
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

    public function updateData($id)
    {
        $modelpegawai = new ModelPegawai();
        $modeluser = new ModelUser();
        $errortext[] = '';
        $message = '';
        $dataJSON = $this->request->getJSON(true);
        $wherepeg = array('id_pegawai' => $id);
        $whereuser = array('id_user' => $id);
        $nama = array('nama' => $dataJSON['nama']);
        if ($this->validator->run($dataJSON, 'textpnsEdit')) {
            array_pop($dataJSON);
            $modelpegawai->updateData($wherepeg, $dataJSON);
            $modeluser->updateData($whereuser, $nama);
            $message = "Berhasil Mengubah Data";
            // }
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
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

    public function getdataPensiun()
    {
        // nanti get data pensiun jika terdapat data pensiun pada tahun tersebut dengna get tahun dan ditambah 2 tahun terakhir
        $model = new ModelPegawai();
        $where = array('role' => 1, 'status' => 1);
        $data = $model->getPegawai($where);
        $thnNow =  date("Y");
        $thnNow = strval(1 + ((int)$thnNow));
        $datapensiun = [];
        foreach ($data as $key) {
            $datepensiun = strtotime($key->tgl_pensiun);
            $tahunPensiun = strval(date("Y", $datepensiun));
            if ($tahunPensiun == $thnNow) {
                $datapensiun[] = $key;
            }
        }
        if ($datapensiun != null) {
            echo json_encode($datapensiun);
        }
    }

    public function getLengthPeg()
    {
        $model = new ModelPegawai();
        $where = array('status' => '1');
        $dataLength = $model->getPegawai($where);
        $dataLength = count($dataLength);
        echo json_encode($dataLength);
    }

    public function getLengthPesan()
    {
        $model = new ModelPesan();
        $modelPeg = new ModelPegawai();

        $where = array('status' => '1');
        $dataLength = $model->getDataPesan();
        $dataLengthTerkirim = $model->getPesan($where);
        $dataLength = count($dataLength);
        $dataLengthTerkirim = count($dataLengthTerkirim);
        $output = array('pesanTerkirim' => $dataLengthTerkirim, 'allPesan' => $dataLength);
        echo json_encode($output);
    }

    public function getChartPensiun()
    {
        $model = new ModelPegawai();
        $data = $model->getPegawais();
        $dataTahun = null;
        $jumlahPensiun = '';
        $clearArray = [];
        foreach ($data as $key) {
            $tahun =  explode('-', $key->tgl_pensiun);
            $dataTahun[] = $tahun[0];
        }
        if ($dataTahun != null) {
            # code...
            $jumlahPensiun = array_count_values($dataTahun);
            $clearArray[] = array_unique($dataTahun);
        }
        $output = array('dataTahun' => $clearArray, 'jumlahPensiun' => $jumlahPensiun);
        echo json_encode($output);
    }

    public function getChartSkp()
    {
        $modelPeg = new ModelPegawai();
        $model = new ModelSKp();
        $arrayPeg = [];
        $arraySkp = [];
        $where = array('tahun_skp' => date("Y"));
        $dataPeg = $modelPeg->getPegawais();
        $dataSkp = $model->getSkps($where);
        foreach ($dataPeg as $key) {
            $arrayPeg[] = $key->nip;
        }
        foreach ($dataSkp as $key) {
            $arraySkp[] = $key->tahun_skp;
        }
        $dataPeg = count($arrayPeg);
        $dataSkp = count($arraySkp);
        if ($dataSkp == 0) {
            $tidakMengirim = $dataPeg;
        } else {
            $tidakMengirim = $dataPeg - $dataSkp;
        }

        $output = array('tidakMengirim' => $tidakMengirim, 'mengirim' => $dataSkp, 'tahun' => date("Y"));
        echo json_encode($output);
    }
}