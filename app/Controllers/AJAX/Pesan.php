<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Controllers\Main\Pensiun as MainPensiun;
use App\Models\ModelPegawai;
use App\Models\ModelPesan;
use App\Models\ModelUser;
use JsonException;

class Pesan extends BaseController
{
    // public function pesanPensiun()
    // {
    //     $modelpegawai = new ModelPegawai();
    //     $years = (int) date('Y');
    //     $years = $years + 2;
    //     $dataPegawai = $modelpegawai->getPegawais();
    //     foreach ($dataPegawai as $pegawai) {
    //         $dateNow = $years;
    //         $datePesiun = (int) strtok($pegawai->tgl_pensiun, '-');
    //         if ($datePesiun >= $dateNow) {
    //             $this->SendNow($pegawai->id_pegawai, 1);
    //         }
    //     }
    // }

    public function SendNow($id_pegawai, $jenis_pesan)
    {
        $modelpesan = new ModelPesan();
        $where = array('id_pegawai' => $id_pegawai);
        $data = $modelpesan->getdataPeg($where);
        foreach ($data as $key) {
            $dataSend = array(
                'email' => $key->email,
                'nip' => $key->nip,
                'nama' => $key->nama,
                'nama_jabatan' => $key->nama_jabatan,
                'nama_pangkat' => $key->nama_pangkat,
            );
            if ($this->sendEmail($dataSend) == true) {
                echo 'sended';
            } else {
                echo '!sended';
                $data = array(
                    'id_pegawai' => $id_pegawai,
                    'status' => '2',
                    'jenis' => $jenis_pesan
                );
                var_dump($data);
                if ($this->validator->run($data, 'pesan')) {
                    $modelpesan->insertData($data);
                }
            }
        }
    }

    public function sendEmail($dataSend)
    {
        $email = \Config\Services::email();
        $email->setTo($dataSend['email']);
        $email->setSubject('Htmls');
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
                    <img src="cid:' . $cid . '" alt="photo1" />
                    </div>
                    <div style="background-color: white;">
                        <table>
                            <tr>
                                <td>Menimbang:      </td>
                                <td>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                    the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley
                                    of type and scrambled it to make a type specimen book. It has survived not only five centuries
                            </td>
                            </tr>
                            <tr>
                                <td>Menimbang:      </td>
                                <td>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                    the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley
                                    of type and scrambled it to make a type specimen book. It has survived not only five centuries
                                </td>
                            </tr>
                            <tr>
                                <td>Menyatakan: </td>
                                <td>
                                1. NIP' . $dataSend['nip'] . '
                                2. Nama'  . $dataSend['nama'] . '
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
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
            '
        );
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
    //berhasil gambar
    // public function sendEmail($emailPegawai)
    // {
    //     $email = \Config\Services::email();
    //     $email->setTo('klungkungbersatubanget@gmail.com');
    //     $email->setSubject('Htmls');
    //     $filename = base_url('/surat/kop.jpg');
    //     $email->attach($filename);
    //     $cid = $email->setAttachmentCID($filename);
    //     $email->setMessage(
    //         '
    //         <html>

    //         <head>
    //         </head>
    //         <body style="margin: 0; padding: 0;">
    //             <div style="width: 670px;">
    //                 <div style="background-color: white;">
    //                 <img src="cid:' . $cid . '" alt="photo1" />
    //                 </div>
    //                 <div style="background-color: white;">
    //                     <table>
    //                         <tr>
    //                             <td>Menimbang:      </td>
    //                             <td>
    //                                 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
    //                                 the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley
    //                                 of type and scrambled it to make a type specimen book. It has survived not only five centuries
    //                         </td>
    //                         </tr>
    //                         <tr>
    //                             <td>Menimbang:      </td>
    //                             <td>
    //                                 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
    //                                 the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley
    //                                 of type and scrambled it to make a type specimen book. It has survived not only five centuries
    //                             </td>
    //                         </tr>
    //                         <tr>
    //                             <td></td>
    //                             <td></td>
    //                         </tr>
    //                         <tr>
    //                             <td></td>
    //                             <td></td>
    //                         </tr>
    //                         <tr>
    //                             <td></td>
    //                             <td></td>
    //                         </tr>
    //                     </table>
    //                 </div>
    //                 <div></div>
    //             </div>
    //         </body>
    //         '
    //     );
    //     if ($email->send()) {
    //         echo 'berhasil';
    //     } else {
    //         echo 'gagal';
    //     }
    // }

}