<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Controllers\Main\Pegawai as MainPegawai;
use App\Models\ModelAuth;
use JsonException;

class Auth extends BaseController
{
    public function index()
    {
        $session = session();
        $model = new ModelAuth();
        $dataJSON = $this->request->getPost();
        $errortext[] = '';
        $message = '';
        if ($this->validator->run($dataJSON, 'login')) {
            $where = array('email' => $dataJSON['email']);
            $dataLogin = $model->getUser($where);
            if ($dataLogin) {
                if ($dataLogin['status'] == 1) {
                    if (password_verify($dataJSON['password'], $dataLogin['password'])) {
                        $session->set($dataLogin);
                        if ($session->get('role') == 3) {
                            return redirect()->to(base_url('/user/admin'));
                        } else {
                            return redirect()->to(base_url('/user/pegawai'));
                        }
                        // echo $this->checkAlreadyLogin();
                    } else {
                        echo "password tidak cocok";
                    }
                } else {
                    echo "user tidak aktie";
                }
            } else {
                echo "Email tidak terdaftar pada sistem";
            }
        } else {
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        // checkAlreadyLogin();
        return redirect()->to(base_url('/login'));
    }
}