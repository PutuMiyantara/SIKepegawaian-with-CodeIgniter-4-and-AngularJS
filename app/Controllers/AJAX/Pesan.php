<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Controllers\AJAX\Pesan as MainPesan;
use App\Models\ModelMutasi;
use App\Models\ModelPesan;
use JsonException;

class Pesan extends BaseController
{
    public function getDataPesan()
    {
        $model = new ModelPesan();
        echo json_encode($model->getDataPesan());
    }

    public function reSend()
    {
        $model = new ModelPesan();
        $modelMutasi = new ModelMutasi();
        $dataJSON = $this->request->getJSON(true);
        $where = array('id_pesan' => $dataJSON['id_pesan']);
        $dataPesan = $model->getPesan($where);
        $message = '';

        if ($dataJSON['jenis'] == 'mutasi') {
            foreach ($dataPesan as $pesan) {
                $whereMutasi = array('id_mutasi_pegawai' => $pesan->id_mutasi_pegawai);
                $dataMutasi = $modelMutasi->getDataMutasi($whereMutasi);
                foreach ($dataMutasi as $mutasi) {
                    $dataSendMutasi = array(
                        'no_sk' => $mutasi->no_sk,
                        'tgl_mutasi' => $mutasi->tgl_mutasi,
                        'unit_tujuan' => $mutasi->unit_tujuan
                    );
                }
                $wherePegawai = array('id_pegawai' => $pesan->id_pegawai);
                $dataPegawai = $model->getdataPeg($wherePegawai);
                foreach ($dataPegawai as $pegawai) {
                    $dataPegawaiMutasi = array(
                        'email' => $pegawai->email,
                        'nip' => $pegawai->nip,
                        'nama' => $pegawai->nama,
                        'email_subject' => 'Perihat Mutasi Pegawai',
                        'nama_pangkat' => $pegawai->nama_pangkat
                    );
                }
                if ($this->emailMutasi($dataPegawaiMutasi, $dataSendMutasi) == true) {
                    $data = array(
                        'status' => '1',
                        'tgl_pesan' => date("Y-m-d")
                    );
                    $message = 'berhasil';
                } else {
                    $data = array(
                        'tgl_pesan' => date("Y-m-d")
                    );
                    $message = 'gagal';
                }
                $whereUpdate = array('id_pesan' => $pesan->id_pesan);
                $model->updateData($whereUpdate, $data);
            }
        } else {
            foreach ($dataPesan as $pesan) {
                $wherePegawai = array('id_pegawai' => $pesan->id_pegawai);
                $dataPegawai = $model->getdataPeg($wherePegawai);
                foreach ($dataPegawai as $pegawai) {
                    $dataSendPensiun = array(
                        'email' => $pegawai->email,
                        'tgl_pensiun' => $pegawai->tgl_pensiun,
                        'nip' => $pegawai->nip,
                        'nama' => $pegawai->nama,
                        'tgl_lahir' => $pegawai->tgl_lahir,
                        'nama_pangkat' => $pegawai->nama_pangkat,
                        'nama_jabatan' => $pegawai->nama_jabatan,
                        'tempat_bekerja' => $pegawai->tempat_bekerja,
                        'email_subject' => 'Perihal Pensiun Pegawai'
                    );
                }
                if ($this->emailPensiun($dataSendPensiun) == true) {
                    $data = array(
                        'status' => '1',
                        'tgl_pesan' => date("Y-m-d")
                    );
                    $message = 'berhasil';
                } else {
                    $data = array(
                        'tgl_pesan' => date("Y-m-d")
                    );
                    $message = 'gagal';
                }
                $whereUpdata = array('id_pesan' => $pesan->id_pesan);
                $model->updateData($whereUpdata, $data);
            }
        }
        $output = array('message' => $message);
        echo json_encode($output);
    }

    public function deletePesan()
    {
        $model = new ModelPesan();
        $dataJSON = $this->request->getJSON(true);
        $model->deletePesan($dataJSON);
    }

    public function pesanPensiun()
    {
        $modelpesan = new ModelPesan();
        $years = (int) date('Y');
        $dateNow = $years + 1;
        $dataPegawai = $modelpesan->getdataPegs();
        $where = array('jenis' => 'pensiun');
        $dataPesan = $modelpesan->getPesan($where);
        $message = '';
        // check pegawai sudah pensiun apa belum dalam waktu 1 tahun kedepan akan mengalami pensiun.
        foreach ($dataPegawai as $pegawai) {
            $datePesiun = (int) strtok($pegawai->tgl_pensiun, '-');
            if ($dateNow >= $datePesiun) {
                // echo " " . $pegawai->id_pegawai . "pensiun";
                // $uniquePeg = array('id_pegawai' => $pegawai->id_pegawai);
                // check pegawai ada di db pesan atau tidak(agar uniqe)
                $check = true;
                foreach ($dataPesan as $key) {
                    if ($pegawai->id_pegawai == $key->id_pegawai) {
                        $check = false;
                    }
                }
                if ($check == true) {
                    echo 'valid';
                    $dataSendPensiun = array(
                        'email' => $pegawai->email,
                        'tgl_pensiun' => $pegawai->tgl_pensiun,
                        'nip' => $pegawai->nip,
                        'nama' => $pegawai->nama,
                        'tgl_lahir' => $pegawai->tgl_lahir,
                        'nama_pangkat' => $pegawai->nama_pangkat,
                        'nama_jabatan' => $pegawai->nama_jabatan,
                        'tempat_bekerja' => $pegawai->tempat_bekerja,
                        'email_subject' => 'Perihat Pensiun Pegawai'
                    );
                    // check data terkirim atau tidak
                    if ($this->emailPensiun($dataSendPensiun) == true) {
                        echo 'terkirim';
                        $data = array(
                            'id_pegawai' => $pegawai->id_pegawai,
                            'status' => '1',
                            'jenis' => 'pensiun',
                            'tgl_pesan' => date("Y-m-d")
                        );
                        $modelpesan->insertData($data);
                    } else {
                        $data = array(
                            'id_pegawai' => $pegawai->id_pegawai,
                            'status' => '2',
                            'jenis' => 'pensiun',
                            'tgl_pesan' => date("Y-m-d")
                        );
                        $modelpesan->insertData($data);
                    }
                }
            }
        }
        // mengirim data pesan pensiun dengan status pesan 2/tidak terkiirm
        foreach ($dataPesan as $pesan) {
            $wherePegawai = array('id_pegawai' => $pesan->id_pegawai);
            $dataPegawai = $modelpesan->getdataPeg($wherePegawai);
            foreach ($dataPegawai as $pegawai) {
                $dataSendPensiun = array(
                    'email' => $pegawai->email,
                    'tgl_pensiun' => $pegawai->tgl_pensiun,
                    'nip' => $pegawai->nip,
                    'nama' => $pegawai->nama,
                    'tgl_lahir' => $pegawai->tgl_lahir,
                    'nama_pangkat' => $pegawai->nama_pangkat,
                    'nama_jabatan' => $pegawai->nama_jabatan,
                    'tempat_bekerja' => $pegawai->tempat_bekerja,
                    'email_subject' => 'Perihat Pensiun Pegawai'
                );
            }
            if ($this->emailPensiun($dataSendPensiun) == true) {
                $data = array(
                    'status' => '1',
                    'tgl_pesan' => date("Y-m-d")
                );
                echo 'berhasil';
            } else {
                $data = array(
                    'tgl_pesan' => date("Y-m-d")
                );
                echo 'gagal';
            }
            $whereUpdata = array('id_pesan' => $pesan->id_pesan);
            $modelpesan->updateData($whereUpdata, $data);
        }
    }

    // public function pesanPensiun()
    // {
    //     $modelpesan = new ModelPesan();
    //     $years = (int) date('Y');
    //     $dateNow = $years + 1;
    //     $dataPegawai = $modelpesan->getdataPegs();
    //     $message = '';
    //     // check pegawai sudah pensiun apa belum dalam waktu 1 tahun kedepan akan mengalami pensiun.
    //     foreach ($dataPegawai as $pegawai) {
    //         $datePesiun = (int) strtok($pegawai->tgl_pensiun, '-');
    //         if ($dateNow >= $datePesiun) {
    //             // echo " " . $pegawai->id_pegawai . "pensiun";
    //             $uniquePeg = array('id_pegawai' => $pegawai->id_pegawai);
    //             // check pegawai masih aktif atau tidak
    //             var_dump($uniquePeg);
    //             if ($this->validator->run($uniquePeg, 'pesan')) {
    //                 echo 'valid';
    //                 $dataSendPensiun = array(
    //                     'email' => $pegawai->email,
    //                     'tgl_pensiun' => $pegawai->tgl_pensiun,
    //                     'nip' => $pegawai->nip,
    //                     'nama' => $pegawai->nama,
    //                     'tgl_lahir' => $pegawai->tgl_lahir,
    //                     'nama_pangkat' => $pegawai->nama_pangkat,
    //                     'nama_jabatan' => $pegawai->nama_jabatan,
    //                     'tempat_bekerja' => $pegawai->tempat_bekerja,
    //                     'email_subject' => 'Perihat Pensiun Pegawai'
    //                 );
    //                 // check data terkirim atau tidak
    //                 if ($this->emailPensiun($dataSendPensiun) == true) {
    //                     echo 'terkirim';
    //                     $data = array(
    //                         'id_pegawai' => $pegawai->id_pegawai,
    //                         'status' => '1',
    //                         'jenis' => 'pensiun',
    //                         'tgl_pesan' => date("Y-m-d")
    //                     );
    //                     $modelpesan->insertData($data);
    //                 } else {
    //                     $data = array(
    //                         'id_pegawai' => $pegawai->id_pegawai,
    //                         'status' => '2',
    //                         'jenis' => 'pensiun',
    //                         'tgl_pesan' => date("Y-m-d")
    //                     );
    //                     $modelpesan->insertData($data);
    //                 }
    //             } else {
    //                 echo "!!!";
    //             }
    //         }
    //         echo "<br>";
    //     }
    // }

    public function pesanMutasi()
    {
        $modelMutasi = new ModelMutasi();
        $modelPesan = new ModelPesan();
        $dataJSON = $this->request->getJSON();
        $where = array('mutasi_pegawai.id_mutasi' => $dataJSON->id_mutasi);
        $dataMutasi = $modelMutasi->getDataMutasi($where);
        $message = '';

        foreach ($dataMutasi as $mutasi) {
            $dataSendMutasi = array(
                'no_sk' => $mutasi->no_sk,
                'tgl_mutasi' => $mutasi->tgl_mutasi,
                'unit_tujuan' => $mutasi->unit_tujuan
            );
            $wherePeg = array('id_pegawai' => $mutasi->id_pegawai);
            $dataPegawai = $modelPesan->getdataPeg($wherePeg);
            foreach ($dataPegawai as $key) {
                $dataPegawaiMutasi = array(
                    'email' => $key->email,
                    'nip' => $key->nip,
                    'nama' => $key->nama,
                    'email_subject' => 'Perihat Mutasi Pegawai',
                    'nama_pangkat' => $key->nama_pangkat
                );
            }
            $uniquemutasi = array('id_mutasi_pegawai' => $mutasi->id_mutasi_pegawai);
            if ($this->validator->run($uniquemutasi, 'pesanMutasi') && $mutasi->status == 1) {
                $data = array(
                    'id_pegawai' => $mutasi->id_pegawai,
                    'id_mutasi_pegawai' => $mutasi->id_mutasi_pegawai,
                    'jenis' => 'mutasi',
                    'status' => '1',
                    'tgl_pesan' => date("Y-m-d")
                );
                if ($this->emailMutasi($dataPegawaiMutasi, $dataSendMutasi) == true) {
                    $data['status'] = '1';
                    $modelPesan->insertData($data);
                } else {
                    $data['status'] = '2';
                    $modelPesan->insertData($data);
                }
            }
        }
        $output = array('message' => $message);
        echo json_encode($output);
    }

    public function emailPensiun($dataSend)
    {
        $email = \Config\Services::email();
        $email->setTo($dataSend['email']);
        $email->setSubject($dataSend['email_subject']);
        $filename = base_url('/surat/kop.jpg');
        $email->attach($filename);
        $cid = $email->setAttachmentCID($filename);
        $email->setMessage(
            '
            <html>
            <head> 
            </head>
            <body style="margin: 0; padding: 0;">
                <div style="width: 670px;">
                <div style="background-color: white;">
                    <img src="cid:' . $cid .
                '" alt="photo1" />
                </div>
                <div style="background-color: white;">
                    <table>
                    <tr>
                        <td><p>Pemberitahuan:</p></td>
                        <td>
                            <p>Bahwa Pegawai Negeri Sipil yang namanya tercantum pada surat pemberitahuan ini 
                            dinyatakan telah mencapai batas usia pensiun pada tanggal ' . $dataSend['tgl_pensiun'] . '. Diharapkan untuk menyiapkan berkas-berkas yang digunakan untuk melakukan pensiun</p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Penerima Pensiun:</p></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>
                                ' . $dataSend['nip'] . '
                        </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>
                                ' . $dataSend['nama'] . '
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>
                                ' . $dataSend['tgl_lahir'] . '
                        </td>
                    </tr>
                    <tr>
                        <td>Pangkat</td>
                        <td>
                                ' . $dataSend['nama_pangkat'] . '
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>
                               ' . $dataSend['nama_jabatan'] . '
                        </td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>
                               ' . $dataSend['tempat_bekerja'] . '
                        </td>
                    </tr>
                    <tr>
                        <td><p style="font-weight: bold;">Note:</p></td>
                        <td>Diharapkan kepada Sdr. ' . $dataSend['nama'] . ' NIP. ' . $dataSend['nip'] .
                ' agar Mengambil SK Pensiun pada Instansi terkait pada tanggal ' . $dataSend['tgl_pensiun'] . '</td>
                    </tr>
                    </table>
                </div>
                <div></div>
                </div>
            </body>
            </html>
            '
        );
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function emailMutasi($dataSend, $dataSendMutasi)
    {
        $email = \Config\Services::email();
        $email->setTo($dataSend['email']);
        $email->setSubject($dataSend['email_subject']);
        $filename = base_url('/surat/kop.jpg');
        $email->attach($filename);
        $cid = $email->setAttachmentCID($filename);
        $email->setMessage(
            '
            <html>
            <head> 
            </head>
            <body style="margin: 0; padding: 0;">
                <div style="width: 670px;">
                <div style="background-color: white;">
                    <img src="cid:' . $cid .
                '" alt="photo1" />
                </div>
                <div style="background-color: white;">
                    <table>
                    <tr>
                        <td><p>Menimbang:</p></td>
                        <td>
                        <ol type="a">
                            <li>
                                Bahwa untuk Kepentingan Dinas di masing-masing Unit Kerja,
                                maka dipandang perlu mengatur pembebasan/pemindahan Pegawai
                                Negeri Sipil.
                            </li>
                            <li>
                                Bahwa pembebasan/pemindahan Pegawai Negeri Sipil tersebut
                                ditetapkan dengan Keputusan Bupati Klungkung.
                            </li>
                        </ol>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Mengingat:</p></td>
                        <td>
                        <ol>
                            <li>
                                Undang-undang Nomor 69 Tahun 1958;
                            </li>
                            <li>
                                Undang-undang Nomor 32 Tahun 2004 jo, Undang-undang Nomor 12
                                Tahun 2008;
                            </li>
                            <li>
                                Undang-undang Nomor 5 Tahun 2014;
                            </li>
                            <li>
                                Peraturan Pemerintahan Nomor 99 Tahun 2000 jo, Peraturan
                                Pemerintahan Nomor 12 Tahun 2002;
                            </li>
                            <li>
                                Peraturan Pemerintahan Nomor 7 Tahun 1997 jo, Peraturan
                                Pemerintahan Nomor 34 Tahun 2014;
                            </li>
                            <li>
                                Peraturan Daerah Kabupaten Klungkung Nomor 8 Tahun 2008.
                            </li>
                        </ol>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><p>MEMUTUSKAN:</p></td>
                    </tr>
                    <tr>
                        <td>
                            <p>Pertama:</p>
                        </td>
                        <td>
                            <p>
                                Membebaskan Sdr. ' . $dataSend['nama'] . ' NIP. ' . $dataSend['nip'] . ', Pangkat
                                ' . $dataSend['nama_pangkat'] . ', lanjut menempatkan yang bersangkutan ke
                                ' . $dataSendMutasi['unit_tujuan'] . '.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Kedua:</p>
                        </td>
                        <td>
                            <p>
                               Kepada PNS yang bersangkutan diberikan gaji dan penghasilan yang
                               sah sesuai peraturan perundang-undangan yang berlaku
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Ketiga:</p>
                        </td>
                        <td>
                            <p>
                                Keputusan ini berlaku terhitung mulai tanggal ditetapkan, dengan
                                ketentuan apabila terdapat kekeliruan akan ditinjau kembali dan
                                diperbaiki sebagainaman mestinya.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Keempat:</p>
                        </td>
                        <td>
                            <p>
                                Keputusan ini disampaikan kepada yang bersangkutan untuk
                                mengetahui dan dipergunakan sebagaimana mestinya
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><p style="font-weight: bold;">Note:</p></td>
                        <td>Diharapkan kepada Sdr. ' . $dataSend['nama'] . ' NIP. ' . $dataSend['nip'] . ' agar Mengambil SK Mutasi pada Instansi terkait</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    </table>
                </div>
                <div></div>
                </div>
            </body>
            </html>
            '
        );
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
}