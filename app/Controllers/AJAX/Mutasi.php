<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelMutasi;
use App\Models\ModelPegawai;
use App\Models\ModelUser;
use JsonException;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Fill;
use PHPExcel_Style_NumberFormat;

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
        $nipunique = null;
        $message = '';
        // mengambil unit asal pegawai
        $where = array('id_pegawai' => $dataJSON['id_pegawai']);
        $unitAsal = $modelpegawai->getPegawai($where);
        // var_dump($unitAsal);
        // die;
        if ($this->validator->run($dataJSON, 'mutasitext')) {
            $where = array('mutasi_pegawai.id_mutasi' => $dataJSON['id_mutasi']);
            $res_idmutasi = $model->getDataMutasi($where);
            $c = true;
            $nipunique = null;
            foreach ($res_idmutasi as $res) :
                if ($dataJSON['id_pegawai'] == $res->id_pegawai) {
                    $c = false;
                }
            endforeach;

            if ($c == true) {
                $model->insertDataMutasi($dataJSON);
                $message = "Berhasil Menyimpan Data Mutasi";
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
        // var_dump($dataJSON);
        // die;
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

    public function toExel($id_mutasi)
    {
        $model = new ModelMutasi();
        $where = array('mutasi_pegawai.id_mutasi' => $id_mutasi);
        $data = $model->getDataMutasi($where);
        // var_dump($data);
        // die;
        $filename = '';

        if (count($data) != 0) {
            require_once(APPPATH . '\PHPExcel-1.8\Classes\PHPExcel.php');
            include(APPPATH . '\PHPExcel-1.8\Classes\PHPExcel\Writer\Excel2007.php');
            $object = new PHPExcel();
            $object->getProperties()->setCreator("Admin");
            $object->getProperties()->setLastModifiedBy("Admin");
            $object->getProperties()->setTitle("Daftar Mutasi Pegawai");

            $object->getActiveSheet()->getStyle('A1:T1')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'FFFF00')
                    )
                )
            );

            // $object->getActiveSheet()->getStyle('')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);

            $object->setActiveSheetIndex(0);
            $object->getActiveSheet()->setCellValue('A1', 'NO');
            $object->getActiveSheet()->setCellValue('B1', 'NO SK MUTASI');
            $object->getActiveSheet()->setCellValue('C1', 'TANGGAL MUTASI');
            $object->getActiveSheet()->setCellValue('D1', 'NIP');
            $object->getActiveSheet()->setCellValue('E1', 'NAMA');
            $object->getActiveSheet()->setCellValue('F1', 'UNIT ASAL');
            $object->getActiveSheet()->setCellValue('G1', 'UNIT TUJUAN');
            $object->getActiveSheet()->setCellValue('H1', 'STATUS MUTASI');

            $baris = 2;
            $no = 1;
            foreach ($data as $key) {
                $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
                $object->getActiveSheet()->setCellValue('B' . $baris, $key->no_sk);
                $object->getActiveSheet()->setCellValue('C' . $baris, $key->tgl_mutasi);
                $object->getActiveSheet()->setCellValue('D' . $baris, ("'" . $key->nip));
                $object->getActiveSheet()->setCellValue('E' . $baris, $key->nama);
                $object->getActiveSheet()->setCellValue('F' . $baris, $key->unit_tujuan);
                $object->getActiveSheet()->setCellValue('G' . $baris, $key->unit_asal);
                $object->getActiveSheet()->setCellValue('H' . $baris, $key->status_mutasi);

                $baris++;
                $filename = 'Data MUTASI No SK' . $key->no_sk . '.xlsx';
            }
            // Save Excel 2007 file
            #echo date('H:i:s') . " Write to Excel2007 format\n";
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
            ob_end_clean();
            // We'll be outputting an excel file
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $objWriter->save('php://output');
            exit;
        }
    }

    public function toExeld($id_mutasi_pegawai)
    {
        $model = new ModelMutasi();
        $where = array('id_mutasi_pegawai' => $id_mutasi_pegawai);
        $data = $model->getSkps($where);

        if (count($data) != 0) {
            require_once(APPPATH . '\PHPExcel-1.8\Classes\PHPExcel.php');
            include(APPPATH . '\PHPExcel-1.8\Classes\PHPExcel\Writer\Excel2007.php');
            $object = new PHPExcel();
            $object->getProperties()->setCreator("Admin");
            $object->getProperties()->setLastModifiedBy("Admin");
            $object->getProperties()->setTitle("Daftar SKP Tahun " . $tahun);

            $object->getActiveSheet()->getStyle('A1:T1')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'FFFF00')
                    )
                )
            );

            $object->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);

            $object->setActiveSheetIndex(0);
            $object->getActiveSheet()->setCellValue('A1', 'NO');
            $object->getActiveSheet()->setCellValue('B1', 'NIP');
            $object->getActiveSheet()->setCellValue('C1', 'NAMA');
            $object->getActiveSheet()->setCellValue('D1', 'NAMA_ATASANPEJABATPENILAI');
            $object->getActiveSheet()->setCellValue('E1', 'NIP_ATASANPEJABATPENILAI');
            $object->getActiveSheet()->setCellValue('F1', 'NAMA_PEJABATPENILAI');
            $object->getActiveSheet()->setCellValue('G1', 'NIP_PEJABATPENILAI');
            $object->getActiveSheet()->setCellValue('H1', 'TAHUN');
            $object->getActiveSheet()->setCellValue('I1', 'NILAI_SKP');
            $object->getActiveSheet()->setCellValue('J1', 'ORIENTASI_PELAYANAN');
            $object->getActiveSheet()->setCellValue('K1', 'INTEGRITAS');
            $object->getActiveSheet()->setCellValue('L1', 'KOMITMEN');
            $object->getActiveSheet()->setCellValue('M1', 'DISIPLIN');
            $object->getActiveSheet()->setCellValue('N1', 'KERJASAMA');
            $object->getActiveSheet()->setCellValue('O1', 'KEPEMIMPINAN');
            $object->getActiveSheet()->setCellValue('P1', 'STATUS_PENILAI');
            $object->getActiveSheet()->setCellValue('Q1', 'STATUS_ATASAN_PENILAI');
            $object->getActiveSheet()->setCellValue('R1', 'UNOR_NAMA'); //JABATAN
            $object->getActiveSheet()->setCellValue('S1', 'UNOR_INDUK_NAMA'); //TMP BEKERJA

            $baris = 2;
            $no = 1;
            foreach ($data as $key) {
                $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
                $object->getActiveSheet()->setCellValue('B' . $baris, ("'" . $key->nip));
                $object->getActiveSheet()->setCellValue('C' . $baris, $key->nama);
                $object->getActiveSheet()->setCellValue('D' . $baris, $key->nama_atasan_pejpen);
                $object->getActiveSheet()->setCellValue('E' . $baris, ("'" . $key->nip_atasan_pejpen));
                $object->getActiveSheet()->setCellValue('F' . $baris, $key->nama_pejpen);
                $object->getActiveSheet()->setCellValue('G' . $baris, ("'" . $key->nip_pejpen));
                $object->getActiveSheet()->setCellValue('H' . $baris, $key->tahun_skp);
                $object->getActiveSheet()->setCellValue('I' . $baris, $key->nilai_skp);
                $object->getActiveSheet()->setCellValue('J' . $baris, $key->nilai_pelayanan);
                $object->getActiveSheet()->setCellValue('K' . $baris, $key->nilai_integritas);
                $object->getActiveSheet()->setCellValue('L' . $baris, $key->nilai_komitmen);
                $object->getActiveSheet()->setCellValue('M' . $baris, $key->nilai_disiplin);
                $object->getActiveSheet()->setCellValue('N' . $baris, $key->nilai_kerjasama);
                $object->getActiveSheet()->setCellValue('O' . $baris, $key->nilai_kepemimpinan);
                $object->getActiveSheet()->setCellValue('P' . $baris, $key->status_pejpen);
                $object->getActiveSheet()->setCellValue('Q' . $baris, $key->status_atasan_pejpen);
                $object->getActiveSheet()->setCellValue('R' . $baris, $key->nama_jabatan);
                $object->getActiveSheet()->setCellValue('S' . $baris, $key->tempat_bekerja);

                $baris++;
            }
            // Save Excel 2007 file
            #echo date('H:i:s') . " Write to Excel2007 format\n";
            $filename = 'Data SKP Tahun' . $tahun . '.xlsx';
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
            ob_end_clean();
            // We'll be outputting an excel file
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $objWriter->save('php://output');
            exit;
        }
    }
}