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
        $errorfoto[] = null;
        $errortext[] = null;
        $message = null;

        $model = new ModelUser();
        $dataJSON = $this->request->getPost();
        $fileFoto = $this->request->getFile('foto');
        $foto = array('foto' => $fileFoto);
        $datatext = array(
            'email' => $dataJSON['email'],
            'password' => $dataJSON['password'],
            'repass' => $dataJSON['repass'],
            'role' => $dataJSON['role'],
        );
        if ($this->validator->run($datatext, 'usertext')) {
            if ($this->validator->run($foto, 'userfoto')) {
                $data = array(
                    'email' => $dataJSON['email'],
                    'password' => password_hash($dataJSON['password'], PASSWORD_DEFAULT),
                    'foto' => $foto['foto']->getRandomName(),
                    'role' => $dataJSON['role'],
                    'status' => $dataJSON['status'],
                );
                if ($foto['foto']->move("./foto", $data['foto'])) {
                    $message = "Berhasil Menyimpan Data";
                    $model->insertData($data);
                } else {
                    $errorfoto[] = "Gagal Menyimpan Foto";
                }
            } else {
                $errorfoto[] = implode(', ', $this->validator->getErrors());
            }
        } else {
            if ($this->validator->run($foto, 'userfoto')) {
                $errorfoto[] = implode(', ', $this->validator->getErrors());
            }
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode("", $errortext);
        $validationfoto = implode("", $errorfoto);
        $output = array('errortext' => $validationtext, 'errorfoto' => $validationfoto, 'message' => $message);
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
        $errorfoto[] = null;
        $errortext[] = null;
        $message = null;
        $model = new ModelUser();
        $dataJSON = $this->request->getPost();
        $fileFoto = $this->request->getFile('foto');
        $foto = array('foto' => $fileFoto);
        $where = array('id_user' => $id_user);
        $fileLama = $this->request->getPost('fileLama');
        // var_dump($dataJSON);
        // die;
        // cek apakah update data isi password apa tidak
        if ($dataJSON['password'] == 'undefined' || $dataJSON['password'] == '' || $dataJSON['password'] == 'null') {
            $datatext = array(
                'email' => $dataJSON['email'],
                'status' => $dataJSON['status'],
                'role' => $dataJSON['role']
            );
            if ($this->validator->run($datatext, 'usertextEdit')) {
                $message = "Data Berhasil Dirubah";
                $model->updateData($where, $datatext);
                if ($this->validator->run($foto, 'userfoto')) {
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
                        $errorfoto[] = "Gagal Menyimpan Foto";
                    }
                } else {
                    $errorfoto[] = implode(', ', $this->validator->getErrors());
                }
            } else {
                if ($this->validator->run($foto, 'userfoto')) {
                    $errorfoto[] = implode(', ', $this->validator->getErrors());
                }
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        } else {
            if ($dataJSON['repass'] == 'undefined' || $dataJSON['repass'] == '' || $dataJSON['repass'] == 'null') {
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
                $message = "Data Berhasil Dirubah";
                $model->updateData($where, $data);
                if ($this->validator->run($foto, 'userfoto')) {
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
                        $errorfoto[] = "Gagal Menyimpan Foto";
                    }
                } else {
                    $errorfoto[] = implode(', ', $this->validator->getErrors());
                }
            } else {
                if ($this->validator->run($foto, 'userfoto')) {
                    $errorfoto[] = implode(', ', $this->validator->getErrors());
                }
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        }

        $validationtext = implode("", $errortext);
        $validationfoto = implode("", $errorfoto);
        $output = array('errortext' => $validationtext, 'errorfoto' => $validationfoto, 'message' => $message);
        echo json_encode($output);
    }
}