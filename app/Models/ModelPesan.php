<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPesan extends Model
{
    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_pesan');
        $query = $builder->insert($data);
        return true;
    }

    public function getdataPeg($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_pegawai');
        $builder->select('email, nama, nip, nama_pangkat, nama_jabatan, tgl_lahir, tgl_pensiun, role');
        $builder->join('tb_pangkat', 'tb_pangkat.id_pangkat = tb_pegawai.id_pangkat');
        $builder->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_pegawai.id_jabatan');
        $builder->join('tb_user', 'tb_user.id_user = tb_pegawai.id_pegawai');
        $query = $builder->getWhere($where);
        return $query->getResult();
    }

    public function getPesan()
    {
        $db = db_connect();
        $builder = $db->table('tb_pesan');
        $builder->select('*');
        $query = $builder->get();
        return $query->getResult();
    }
}