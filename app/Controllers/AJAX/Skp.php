<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\modelSKp;
use App\Models\ModelPegawai;

class Skp extends BaseController
{
    public function index()
    {
        $this->getTahunSkp();
    }

    public function getSkp($tahunSkp)
    {
        $model = new modelSKp();
        if ($tahunSkp == "0000") {
            echo json_encode($model->getSkpAll());
        } else {
            $tahun = array('tahun_skp' => $tahunSkp);
            echo json_encode($model->getSkps($tahun));
        }
    }

    public function getTahunSkp()
    {
        $model = new modelSKp();
        echo json_encode($model->getTahun());
    }

    public function insertDataSkp()
    {
        $model = new modelSKp();
        $errortext[] = '';
        $message = '';
        $skpunique = '';
        $dataJSON = $this->request->getJSON(true);
        $where = array('tb_skp.id_pegawai' => $dataJSON['id_pegawai']);
        $check = $model->getSkps($where);
        $c = true;

        if ($dataJSON['status_atasan_pejpen'] == 'Bupati') {
            $dataJSON['nip_atasan_pejpen'] = '000000000000000000';
        }
        if ($this->validator->run($dataJSON, 'skptext')) {
            foreach ($check as $key) {
                if ($key->tahun_skp == $dataJSON['tahun_skp']) {
                    $c = false;
                }
            }
            if ($c == true) {
                if ($dataJSON['status_atasan_pejpen'] == 'Bupati') {
                    $dataJSON['nip_atasan_pejpen'] = null;
                }
                $model->insertData($dataJSON);
                $message = "Berhasil Menyimpan Data";
            } else {
                $skpunique = 'Data SKP Sudah Terdapat Pada Tahun ';
            }
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }

        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'skpunique' => $skpunique, 'message' => $message);
        echo json_encode($output);
    }

    // public function insertDataSkp()
    // {
    //     $model = new modelSKp();
    //     $data = json_decode(file_get_contents("php://input"));
    //     $id_pegawai = $data->id_pegawai;
    //     $tahun_skp = $data->tahun_skp;
    //     $nama_atasan_pejpen = $data->nama_atasan_pejpen;
    //     $nip_atasan_pejpen = $data->nip_atasan_pejpen;
    //     $status_atasan_pejpen = $data->status_atasan_pejpen;
    //     $nama_pejpen = $data->nama_pejpen;
    //     $nip_pejpen = $data->nip_pejpen;
    //     $status_pejpen = $data->status_pejpen;
    //     $nilai_skp = $data->nilai_skp;
    //     $nilai_pelayanan = $data->nilai_pelayanan;
    //     $nilai_integritas = $data->nilai_integritas;
    //     $nilai_komitmen = $data->nilai_komitmen;
    //     $nilai_disiplin = $data->nilai_disiplin;
    //     $nilai_kerjasama = $data->nilai_kerjasama;
    //     $nilai_kepemimpinan = $data->nilai_kepemimpinan;

    //     $where = array('tb_skp.id_pegawai' => $id_pegawai);
    //     $check = $model->getSkps($where);
    //     // echo json_encode($check);
    //     $c = true;
    //     foreach ($check as $key) {
    //         if ($key->tahun_skp == $tahun_skp) {
    //             $c = false;
    //         }
    //     }
    //     if ($c == true) {
    //         $data = array(
    //             'id_pegawai' => $id_pegawai,
    //             'nama_atasan_pejpen' => $nama_atasan_pejpen,
    //             'nip_atasan_pejpen' => $nip_atasan_pejpen,
    //             'status_atasan_pejpen' => $status_atasan_pejpen,
    //             'nama_pejpen' => $nama_pejpen,
    //             'nip_pejpen' => $nip_pejpen,
    //             'status_pejpen' => $status_pejpen,
    //             'tahun_skp' => $tahun_skp,
    //             'nilai_skp' => $nilai_skp,
    //             'nilai_pelayanan' => $nilai_pelayanan,
    //             'nilai_integritas' => $nilai_integritas,
    //             'nilai_komitmen' => $nilai_komitmen,
    //             'nilai_disiplin' => $nilai_disiplin,
    //             'nilai_kerjasama' => $nilai_kerjasama,
    //             'nilai_kepemimpinan' => $nilai_kepemimpinan
    //         );
    //         $model->insertData($data);
    //     } else {
    //         echo "gagal";
    //     }
    // }

    public function getNameNipPeg()
    {
        $model = new ModelPegawai();
        $role = array(
            'role' => '1'
        );
        echo json_encode($model->getPegawai($role));
    }

    public function getDetail($id_skp)
    {
        $modeldetail = new modelSKp();
        $idSkp = array('id_skp' => $id_skp);
        echo json_encode($modeldetail->getSkp($idSkp));
    }

    public function updateSkp($id_skp)
    {
        $model = new modelSKp();
        $errortext[] = '';
        $message = '';
        $skpunique = '';
        $dataJSON = $this->request->getJSON(true);
        $c = true;

        if ($dataJSON['status_atasan_pejpen'] == 'Bupati') {
            $dataJSON['nip_atasan_pejpen'] = '000000000000000000';
        }
        if ($this->validator->run($dataJSON, 'skptext')) {
            $where = array('tb_skp.id_pegawai' => $dataJSON['id_pegawai']);
            $resIdPeg = $model->getSkps($where);
            $where = array('tb_skp.id_skp' => $id_skp);
            $resIdSkp = $model->getSkp($where);
            foreach ($resIdSkp as $key) :
                if ($key->id_pegawai == $dataJSON['id_pegawai'] && $key->tahun_skp == $dataJSON['tahun_skp']) {
                    // kondisi masih true
                } else {
                    foreach ($resIdPeg as $key) {
                        if ($key->tahun_skp == $dataJSON['tahun_skp']) {
                            $c = false;
                        }
                    }
                    //kondisi masi true jika tidak melewati "if ($dataJSON['id_pegawai'] == $res->id_pegawai)" di atas $resIdMutasi
                }
            endforeach;
            if ($c == true) {
                if ($dataJSON['status_atasan_pejpen'] == 'Bupati') {
                    $dataJSON['nip_atasan_pejpen'] = null;
                }
                $where = array('id_skp' => $id_skp);
                $model->updateData($where, $dataJSON);
                $message = "Berhasil Mengubah Data";
            } else {
                $skpunique = 'Data SKP Sudah Terdapat Pada Tahun ';
            }
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }

        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'skpunique' => $skpunique, 'message' => $message);
        echo json_encode($output);
    }

    // public function updateSkp($id_skp)
    // {
    //     $model = new modelSKp();
    //     $errortext[] = '';
    //     $message = '';
    //     $skpunique = '';
    //     $dataJSON = $this->request->getJSON(true);
    //     $where = array('tb_skp.id_pegawai' => $dataJSON['id_pegawai']);
    //     $check = $model->getSkps($where);
    //     $c = true;

    //     if ($dataJSON['status_atasan_pejpen'] == 'Bupati') {
    //         $dataJSON['nip_atasan_pejpen'] = '000000000000000000';
    //     }
    //     if ($this->validator->run($dataJSON, 'skptext')) {
    //         foreach ($check as $key) {
    //             if ($key->tahun_skp == $dataJSON['tahun_skp']) {
    //                 $c = false;
    //             }
    //         }
    //         if ($c == true) {
    //             if ($dataJSON['status_atasan_pejpen'] == 'Bupati') {
    //                 $dataJSON['nip_atasan_pejpen'] = null;
    //             }
    //             $where = array('id_skp' => $id_skp);
    //             $model->updateData($where, $dataJSON);
    //             $message = "Berhasil Menyimpan Data";
    //         } else {
    //             $skpunique = 'Data SKP Sudah Terdapat Pada Tahun ';
    //         }
    //     } else {
    //         $errortext[] = implode(', ', $this->validator->getErrors());
    //     }

    //     $validationtext = implode('', $errortext);
    //     $output = array('errortext' => $validationtext, 'skpunique' => $skpunique, 'message' => $message);
    //     echo json_encode($output);
    // }

    public function getRiwayatSKP($id_pegawai)
    {
        $model = new modelSKp();
        $id_pegawai = array('tb_skp.id_pegawai' => $id_pegawai);
        echo json_encode($model->getSkps($id_pegawai));
    }

    public function deleteSkp()
    {
        $model = new modelSKp();
        $idskp = $this->request->getJSON(true);
        $id_skp = array('id_skp' => $idskp);
        $model->deleteSkp($id_skp);
    }
}