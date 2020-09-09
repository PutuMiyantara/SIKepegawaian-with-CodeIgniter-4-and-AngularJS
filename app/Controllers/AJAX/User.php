<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Controllers\Main\Pegawai as MainPegawai;
use App\Models\ModelUser;
use JsonException;

class User extends BaseController
{
    public function __construct()
    {
        $this->muser = new ModelUser();
    }
    public function index()
    {
        echo json_encode($this->muser->getUsers());
    }

    public function insertData()
    {
        $error[] = null;
        $message = null;
        $model = new ModelUser();
        $dataJSON = $this->request->getPost();
        $fileFoto = $this->request->getFile('foto');
        $foto = array('foto' => $fileFoto);

        if ($dataJSON['email'] == 'undefined') {
            $dataJSON['email'] = null;
        }
        if ($dataJSON['password'] == 'undefined') {
            $dataJSON['password'] = null;
        }
        if ($dataJSON['repass'] == 'undefined') {
            $dataJSON['repass'] = null;
        }

        $datatext = array(
            'email' => $dataJSON['email'],
            'password' => $dataJSON['password'],
            'repass' => $dataJSON['repass'],
        );
        if ($this->validator->run($datatext, 'usertext') && $this->validator->run($foto, 'userfoto')) {
            $data = array(
                'email' => $dataJSON['email'],
                'password' => password_hash($dataJSON['password'], PASSWORD_DEFAULT),
                'foto' => $foto['foto']->getRandomName(),
                'role' => '1',
                'status' => '1',
            );
            if ($foto['foto']->move("./foto", $data['foto'])) {
                $message = "Berhasil Menyimpan Data";
                $model->insertData($data);
            } else {
                $error[] = "Gagal Menyimpan Foto";
            }
        } else {
            if ($this->validator->run($foto, 'userfoto')) {
                $error[] = implode(', ', $this->validator->getErrors());
            }
            $error[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode("", $error);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function getDetail($where)
    {
        $modeldetail = new ModelUser();
        $where = array('id_user' => $where);
        echo json_encode($modeldetail->getUser($where));
    }

    public function updateData($id_user)
    {
        $error[] = null;
        $message = null;
        $model = new ModelUser();
        $dataJSON = $this->request->getPost();
        $fileFoto = $this->request->getFile('foto');
        $foto = array('foto' => $fileFoto);
        $where = array('id_user' => $id_user);
        $fileLama = $this->request->getPost('fileLama');
        // jika tidak update password
        if ($dataJSON['password'] == 'null' || $dataJSON['password'] == '' || $dataJSON['password'] == 'undefined') {
            $datatext = array(
                'email' => $dataJSON['email'],
                'status' => $dataJSON['status'],
                'role' => $dataJSON['role']
            );
            if ($this->validator->run($datatext, 'usertextEdit')) {
                // jika mengubah foto
                if ($this->validator->run($foto, 'uploaded')) {
                    if ($this->validator->run($foto, 'userfotoEdit')) {
                        $message = "Berhasil Mengubah Data";
                        $model->updateData($where, $datatext);
                        $fotoName = $fileFoto->getRandomName();
                        if ($fileFoto->move("./foto", $fotoName)) {
                            $data = array(
                                'foto' => $fotoName,
                            );
                            $model->updateData($where, $data);
                            if ($fileLama != null) {
                                $fileFoto = $this->request->getFile('fileLama');
                                unlink("." . $fileLama);
                            }
                        } else {
                            $error[] = "Gagal Menyimpan Foto";
                        }
                    } else {
                        $error[] = implode(', ', $this->validator->getErrors());
                    }
                } else {
                    $message = "Berhasil Mengubah Data";
                    $model->updateData($where, $datatext);
                }
            } else {
                $error[] = implode(', ', $this->validator->getErrors());
            }
            // jika tidak update password
        } else {
            if ($dataJSON['repass'] == '' || $dataJSON['repass'] == 'null' || $dataJSON['repass'] == 'undefined') {
                $datatext = array(
                    'email' => $dataJSON['email'],
                    'status' => $dataJSON['status'],
                    'password' => $dataJSON['password'],
                    'repass' => null,
                    'role' => $dataJSON['role']
                );
            } else {
                $datatext = array(
                    'email' => $dataJSON['email'],
                    'status' => $dataJSON['status'],
                    'password' => $dataJSON['password'],
                    'repass' => $dataJSON['repass'],
                    'role' => $dataJSON['role']
                );
            }
            if ($this->validator->run($datatext, 'usertext')) {
                $data = array(
                    'email' => $dataJSON['email'],
                    'status' => $dataJSON['status'],
                    'password' => password_hash($dataJSON['password'], PASSWORD_DEFAULT),
                    'role' => $dataJSON['role']
                );
                // jika mengubah foto
                if ($this->validator->run($foto, 'uploaded')) {
                    if ($this->validator->run($foto, 'userfotoEdit')) {
                        $message = "Berhasil Mengubah Data";
                        $model->updateData($where, $data);
                        $fotoName = $fileFoto->getRandomName();
                        if ($fileFoto->move("./foto", $fotoName)) {
                            $data = array(
                                'foto' => $fotoName,
                            );
                            $model->updateData($where, $data);
                            if ($fileLama != null) {
                                $fileFoto = $this->request->getFile('fileLama');
                                unlink("." . $fileLama);
                            }
                        } else {
                            $error[] = "Gagal Menyimpan Foto";
                        }
                    } else {
                        $error[] = implode(', ', $this->validator->getErrors());
                    }
                } else {
                    $message = "Berhasil Mengubah Data";
                    $model->updateData($where, $datatext);
                }
            } else {
                $error[] = implode(', ', $this->validator->getErrors());
            }
        }

        $validationtext = implode("", $error);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }
}