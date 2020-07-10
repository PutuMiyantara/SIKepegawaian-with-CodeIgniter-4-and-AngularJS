<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model
{
    // dengan offset
    // public function getPegawais($limit = 10, $offset = 0)
    // {
    //     $db = db_connect();
    //     $builder = $db->table('tb_pegawai');
    //     $builder = $db->table('tb_user');
    //     $builder->select('*');
    //     $builder->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_user.id_user');
    //     $query = $builder->get($limit, $offset);

    //     return $query->getResult();
    // }

    public function getPegawais()
    {
        $db = db_connect();
        $builder = $db->table('tb_pegawai');
        $builder->select('*');
        $builder->join('tb_user', 'tb_user.id_user = tb_pegawai.id_pegawai');
        $query = $builder->get();

        return $query->getResult();
    }

    public function getPegawai($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_pegawai');
        $builder->select('*');
        $builder->join('tb_user', 'tb_user.id_user = tb_pegawai.id_pegawai');
        $query = $builder->getWhere($where);

        return $query->getResult();
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_pegawai');
        $query = $builder->insert($data);
        return true;
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_pegawai');
        $builder->where($where);
        $builder->update($data);
    }
}