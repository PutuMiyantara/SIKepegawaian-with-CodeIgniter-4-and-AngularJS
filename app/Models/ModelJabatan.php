<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJabatan extends Model
{
    public function getJabatan()
    {
        $db = db_connect();
        $builder = $db->table('tb_jabatan');
        $query = $builder->get();

        return $query->getResult();
    }

    public function getDetailJabatan($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_jabatan');
        $query = $builder->getWhere($where);

        return $query->getResult();
    }

    public function deleteJabatan($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_jabatan');
        $query = $builder->delete($where);
    }

    public function editData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_jabatan');
        $builder->where($where);
        $builder->update($data);
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_jabatan');
        $builder->insert($data);
    }
}