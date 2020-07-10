<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    public function getUsers()
    {
        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->select('*');
        $builder->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_user.id_user');
        $query = $builder->get();

        return $query->getResult();
    }

    public function getUser($id)
    {
        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->select('id_user,email,role, status,foto,nama');
        $query = $builder->getWhere($id);

        return $query->getResult();
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_user');
        $query = $builder->insert($data);
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function getlast()
    {
        $db = db_connect();
        $builder = $db->table('tb_user');
        $query = $builder->get();

        return $query->getLastRow();
    }

    public function deleteLastInsert($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->delete($where);
        return true;
    }
}