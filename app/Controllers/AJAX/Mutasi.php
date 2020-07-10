<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelMutasi;
use App\Models\ModelPegawai;
use App\Models\ModelUser;
use JsonException;

class Mutasi extends BaseController
{
    public function index()
    {
        $model = new ModelMutasi();
        echo json_encode($model->getSKMutasi());
    }

    public function getDataMutasi($id_mutasi)
    {
        $model = new ModelMutasi();
        $where = array('mutasi_pegawai.id_mutasi' => $id_mutasi);
        // $where = array('tb_mutasi.id_mutasi' => $id_mutasi);

        echo json_encode($model->getDataMutasi($where));
    }

    public function getDetailSKMutasi($id)
    {
        $model = new ModelMutasi();
        $where = array('tb_mutasi.id_mutasi' => $id);
        echo json_encode($model->getDetailSKMutasi($where));
    }

    public function updateSKMutasi($id_mutasi)
    {
        $model = new ModelMutasi();
        $dataJSON = $this->request->getJSON(true);
        $where = array('id_mutasi' => $id_mutasi);
        $errortext[] = '';
        $message = '';
        if ($this->validator->run($dataJSON, 'skmutasiedit')) {
            $model->updateSKMutasi($where, $dataJSON);
            $message = "Berhasil Mengubah Data";
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function getDetailMutasi($id_mutasi_pegawai)
    {
        $model = new ModelMutasi();
        $idMutasipegawai = array('id_mutasi_pegawai' => $id_mutasi_pegawai);
        echo json_encode($model->getDetailMutasi($idMutasipegawai));
    }


    // private function check($var)
    // {
    //     $model = $var['model'];

    //     $id_mutasi = $var['id_mutasi'];
    //     $id_mutasi_pegawai = $var['id_mutasi_pegawai'];
    //     $id_pegawai = $var['id_pegawai'];

    //     $w_id_mutasi = array('mutasi_pegawai.id_mutasi' => $id_mutasi);
    //     $id_mutasi_pegawai = array('id_mutasi_pegawai' => $id_mutasi_pegawai);
    //     $res_idpegawai = $model->getDetailMutasi($id_mutasi_pegawai);
    //     $c = true;

    //     foreach ($res_idpegawai as $key) {
    //         if ($key->id_pegawai == $id_pegawai $ke) {
    //             // kondisi masih true
    //         } else {
    //             $res_idmutasi = $model->getDataMutasi($w_id_mutasi);
    //             foreach ($res_idmutasi as $res) :
    //                 if ($id_pegawai == $res->id_pegawai) {
    //                     $c = false;
    //                 }
    //             endforeach;
    //             // kondisi masih true jika tidak melalui if di atas
    //         }
    //     }
    //     return $c;
    // }
    public function updateDataMutasi($id_mutasi_pegawai)
    {
        $model = new ModelMutasi();
        $modelPegawai = new ModelPegawai();
        $modelUser = new ModelUser();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        $c = true;
        $nipunique = null;

        $data = array(
            'id_mutasi' => $dataJSON['id_mutasi'],
            'unit_tujuan' => $dataJSON['unit_tujuan'],
            'status_mutasi' => $dataJSON['status_mutasi']
        );
        if ($this->validator->run($dataJSON, 'mutasitext')) {
            $idMutasi = array('mutasi_pegawai.id_mutasi' => $dataJSON['id_mutasi']);
            $resIdMutasi = $model->getDataMutasi($idMutasi);
            $where = array('id_mutasi_pegawai' => $id_mutasi_pegawai);
            $resIdPegawai = $model->getDetailMutasi($where);
            foreach ($resIdPegawai as $key) :
                if ($key->id_pegawai == $dataJSON['id_pegawai'] && $key->id_mutasi == $dataJSON['id_mutasi']) {
                    // kondisi masi true
                } else {
                    foreach ($resIdMutasi as $res) :
                        if ($dataJSON['id_pegawai'] == $res->id_pegawai) {
                            $c = false;
                        }
                    endforeach;
                    //kondisi masi true jika tidak melewati if di atas $resIdMutasi
                }
            endforeach;
            if ($c == true) {
                $model->updateDataMutasi($where, $data);
                $message = "Berhasil Mengubah Data";
                if ($dataJSON['status_mutasi'] == 1) {
                    $wherepeg = array('id_pegawai' => $dataJSON['id_pegawai']);
                    $unitBekerja = array('tempat_bekerja' => $dataJSON['unit_tujuan']);
                    $modelPegawai->updateData($wherepeg, $unitBekerja);
                    $whereuser = array('id_user' => $dataJSON['id_pegawai']);
                    $statusUser = array('status' => '1');
                    $modelUser->updateData($whereuser, $statusUser);
                } else if ($dataJSON['status_mutasi'] == 2) {
                    $wherepeg = array('id_pegawai' => $dataJSON['id_pegawai']);
                    $unitBekerja = array('tempat_bekerja' => $dataJSON['unit_tujuan']);
                    $modelPegawai->updateData($wherepeg, $unitBekerja);
                    $whereuser = array('id_user' => $dataJSON['id_pegawai']);
                    $statusUser = array('status' => '2');
                    $modelUser->updateData($whereuser, $statusUser);
                }
            } else {
                $nipunique = "false";
            }
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'nipunique' => $nipunique, 'message' => $message);
        echo json_encode($output);
    }

    public function insertDataSKMutasi()
    {
        $model = new ModelMutasi();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        if ($this->validator->run($dataJSON, 'skmutasi')) {
            $message = "Berhasil Menyimpan Data";
            $model->insertDataSKMutasi($dataJSON);
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function insertDataMutasi()
    {
        $model = new ModelMutasi();
        $modelpegawai = new ModelPegawai();
        $modelUser = new ModelUser();
        $dataJSON = $this->request->getJSON(true);
        $errortext[] = '';
        $message = '';
        $where = array('mutasi_pegawai.id_mutasi' => $dataJSON['id_mutasi']);
        $res_idmutasi = $model->getDataMutasi($where);

        // cek nip ada di no sk yang sama atau tidak
        $c = true;
        $nipunique = null;
        foreach ($res_idmutasi as $res) :
            if ($dataJSON['id_pegawai'] == $res->id_pegawai) {
                $c = false;
            }
        endforeach;

        if ($this->validator->run($dataJSON, 'mutasitext')) {
            if ($c == true) {
                $model->insertDataMutasi($dataJSON);
                $message = "Berhasil Menyimpan Data";
                if ($dataJSON['status_mutasi'] == 1) {
                    $wherepeg = array('id_pegawai' => $dataJSON['id_pegawai']);
                    $dataunitbekerja = array('tempat_bekerja' => $dataJSON['unit_tujuan']);
                    $modelpegawai->updateData($wherepeg, $dataunitbekerja);
                    $whereuser = array('id_user' => $dataJSON['id_pegawai']);
                    $statusUser = array('status' => '1');
                    $modelUser->updateData($whereuser, $statusUser);
                } else if ($dataJSON['status_mutasi'] == 2) {
                    $wherepeg = array('id_pegawai' => $dataJSON['id_pegawai']);
                    $dataunitbekerja = array('tempat_bekerja' => $dataJSON['unit_tujuan']);
                    $modelpegawai->updateData($wherepeg, $dataunitbekerja);
                    $whereuser = array('id_user' => $dataJSON['id_pegawai']);
                    $statusUser = array('status' => '2');
                    $modelUser->updateData($whereuser, $statusUser);
                }
            } else {
                $nipunique = "false";
            }
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'nipunique' => $nipunique, 'message' => $message);
        echo json_encode($output);
    }

    public function getRiwayatMutasi($id_pegawai)
    {
        $model = new ModelMutasi();
        $where = array('tb_pegawai.id_pegawai' => $id_pegawai);
        echo json_encode($model->getDataMutasi($where));
    }

    public function deleteMutasi()
    {
        $model = new ModelMutasi();
        $modelPegawai = new ModelPegawai();
        $modelUser = new ModelUser();
        $dataJSON = $this->request->getJSON(true);
        $idMutasiPegawai = array('id_mutasi_pegawai' => $dataJSON['id_mutasi_pegawai']);

        $wherepeg = array('id_pegawai' => $dataJSON['id_pegawai']);
        $dataunitbekerja = array('tempat_bekerja' => $dataJSON['tmp_bekerja_sebelumnya']);
        $whereuser = array('id_user' => $dataJSON['id_pegawai']);
        $statusUser = array('status' => '1');

        $model->deleteMutasi($idMutasiPegawai);
        $modelPegawai->updateData($wherepeg, $dataunitbekerja);
        $modelUser->updateData($whereuser, $statusUser);
    }

    public function deleteSKMutasi()
    {
        $model = new ModelMutasi();
        $data = json_decode(file_get_contents("php://input"));
        $where = $data->id_mutasi;
        $where = array('id_mutasi' => $where);
        $model->deleteSKMutasi($where);
    }
}