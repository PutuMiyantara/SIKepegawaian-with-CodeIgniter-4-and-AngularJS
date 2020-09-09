<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model
{
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
        $builder->join('tb_pangkat', 'tb_pangkat.id_pangkat = tb_pegawai.id_pangkat');
        $builder->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_pegawai.id_jabatan');
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

    public function getTahunPensiun()
    {
        $db = db_connect();
        $builder = $db->table('tb_pegawai');
        $builder->select('tgl_pensiun');
        $builder->distinct();
        $builder->orderBy('tgl_pensiun', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}