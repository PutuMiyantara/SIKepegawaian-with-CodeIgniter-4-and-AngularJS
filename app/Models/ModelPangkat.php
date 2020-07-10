<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPangkat extends Model
{
    public function getPangkat()
    {
        $db = db_connect();
        $builder = $db->table('tb_pangkat');
        $query = $builder->get();

        return $query->getResult();
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_pangkat');
        $query = $builder->insert($data);
    }

    public function deletePangkat($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_pangkat');
        $builder->delete($where);
    }

    public function detailPangkat($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_pangkat');
        $query = $builder->getWhere($where);
        return $query->getResult();
    }

    public function editData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_pangkat');
        $builder->where($where);
        $builder->update($data);
    }
}