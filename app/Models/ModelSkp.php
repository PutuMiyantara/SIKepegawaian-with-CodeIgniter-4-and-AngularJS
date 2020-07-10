<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSKp extends Model
{
    // public function getSkp($tahun)
    // {
    //     $db = db_connect();
    //     $builder = $db->table('tb_pegawai');
    //     $builder->select('*');
    //     $builder->join('tb_skp', 'tb_skp.id_pegawai = tb_pegawai.id_pegawai', 'left');
    //     $builder->join('tb_user', 'tb_user.id_user = tb_pegawai.id_pegawai');
    //     $builder->orderBy('tahun_skp', 'DESC');
    //     $query = $builder->getWhere(['role' => '1']);

    //     return $query->getResult();
    // }

    public function getSkps($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_skp');
        $builder->select('*');
        $builder->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_skp.id_pegawai');
        $builder->join('tb_user', 'tb_user.id_user = tb_skp.id_pegawai');
        // $builder->join('tb_user', 'tb_user.id_user = tb_pegawai.id_pegawai'); memastikan pns atau tidak
        // $builder->where(['role' => '1']); memastikan pns atau tidak
        $builder->orderBy('nip', 'ASC');
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getSkp($idskp)
    {
        $db = db_connect();
        $builder = $db->table('tb_skp');
        $builder->select('*');
        $query = $builder->getWhere($idskp);
        return $query->getResult();
    }

    public function getSkpAll()
    {
        $db = db_connect();
        $builder = $db->table('tb_pegawai');
        $builder->select('*');
        $builder->join('tb_skp', 'tb_skp.id_pegawai = tb_pegawai.id_pegawai');
        $builder->join('tb_user', 'tb_user.id_user = tb_pegawai.id_pegawai');
        $builder->where(['role' => '1']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getTahun()
    {
        $db = db_connect();
        $builder = $db->table('tb_skp');
        $builder->select('tahun_skp');
        $builder->distinct();
        $builder->orderBy('tahun_skp', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_skp');
        $query = $builder->insert($data);
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_skp');
        $builder->where($where);
        $builder->update($data);
    }

    public function deleteSkp($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_skp');
        $builder->delete($where);
    }
}