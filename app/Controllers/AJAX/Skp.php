<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\modelSKp;
use App\Models\ModelPegawai;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Fill;
use PHPExcel_Style_NumberFormat;

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

    public function insertDataSkp($statusAtasanPejpen)
    {
        $model = new modelSKp();
        $errortext[] = '';
        $message = '';
        $skpunique = '';
        $dataJSON = $this->request->getJSON(true);

        // 1 == bupati, 2 == pns
        if ($statusAtasanPejpen == 1) {
            $dataJSON['nip_atasan_pejpen'] = '000000000000000000';
        }
        if ($this->validator->run($dataJSON, 'skptext')) {
            $where = array('tb_skp.id_pegawai' => $dataJSON['id_pegawai']);
            $check = $model->getSkps($where);
            $c = true;
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
                $message = "Berhasil Menyimpan Data SKP";
            } else {
                $skpunique = 'Data SKP Pegawai Sudah Terdapat Pada Tahun SKP ';
            }
        } else {
            $errortext[] = implode(', ', $this->validator->getErrors());
        }

        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'skpunique' => $skpunique, 'message' => $message);
        echo json_encode($output);
    }

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

    public function toExel($tahun)
    {
        $model = new modelSKp();
        $where = array('tahun_skp' => $tahun);
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