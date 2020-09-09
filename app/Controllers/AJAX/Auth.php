<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Controllers\AJAX\Pesan as Pesan;
use App\Models\ModelAuth;
use App\Models\ModelPegawai;
use App\Models\ModelPesan;
use App\Models\ModelUser;
use CodeIgniter\CLI\Console;
use JsonException;

class Auth extends BaseController
{
    public function index()
    {
        // $this->pensiun();
        $session = session();
        $model = new ModelAuth();
        $dataJSON = $this->request->getJSON(true);
        $message = [];
        $login = '';
        if ($this->validator->run($dataJSON, 'login')) {
            $where = array('email' => $dataJSON['email']);
            $dataLogin = $model->getUser($where);
            if ($dataLogin) {
                if ($dataLogin['status'] == 1) {
                    if (password_verify($dataJSON['password'], $dataLogin['password'])) {
                        $session->set($dataLogin);
                        if ($session->get('role') == 3) {
                            // return redirect()->to(base_url('/home/admin'));
                            $login = 'admin';
                        } else {
                            $login = 'pegawai';
                            // return redirect()->to(base_url('/home/pegawai'));
                        }
                        // echo $this->checkAlreadyLogin();
                    } else {
                        $message[] = "Password Salah";
                    }
                } else {
                    $message[] = "User Tidak Aktif";
                }
            } else {
                $message[] = 'User Tidak Terdaftar Pada Sistem';
            }
        } else {
            $message[] = implode(', ', $this->validator->getErrors());
        }
        $message = implode(', ', $message);
        $output = array('dataLogin' => $message, 'checkUser' => $login);
        echo json_encode($output);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        // checkAlreadyLogin();
        return redirect()->to(base_url('/login'));
    }

    public function pensiun()
    {
        $model = new ModelPegawai();
        $modelUser = new ModelUser();
        $years = (int) date('Y');
        $dateNow = $years + 1;
        $data = $model->getPegawais();
        foreach ($data as $key) {
            if ($key->tgl_pensiun == $dateNow) {
                $where = array('id_user' => $key->id_pegawai);
                $data = array('status' => '2');
                $modelUser->updateData($where, $data);
            }
        }
    }
}