<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMutasi extends Model
{
    public function getSKMutasi()
    {
        // $db = db_connect();
        // $builder = $db->table('tb_mutasi');
        // $query = $builder->get();

        // return $query->getResult();

        $db = db_connect();
        $builder = $db->table('tb_mutasi');
        // $builder->join('mutasi_pegawai', 'mutasi_pegawai.id_mutasi = tb_mutasi.id_mutasi');
        // $builder->distinct('no_sk');
        $builder->orderBy('tgl_mutasi', 'ASC');
        // $builder->select('*');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDataMutasi($where)
    {
        $db = db_connect();
        $builder = $db->table('mutasi_pegawai');
        $builder->select('id_mutasi_pegawai, mutasi_pegawai.id_mutasi, no_sk, tgl_mutasi, unit_asal, unit_tujuan, status_mutasi, tb_pegawai.id_pegawai, nip, tb_user.nama, tb_user.status, tb_user.role');
        $builder->join('tb_mutasi', 'mutasi_pegawai.id_mutasi = tb_mutasi.id_mutasi');
        $builder->join('tb_pegawai', 'tb_pegawai.id_pegawai = mutasi_pegawai.id_pegawai');
        $builder->join('tb_user', 'tb_pegawai.id_pegawai = tb_user.id_user');
        $builder->orderBy('tgl_mutasi', 'ASC');
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDetailSKMutasi($id_mutasi)
    {
        $db = db_connect();
        $builder = $db->table('tb_mutasi');
        $query = $builder->getWhere($id_mutasi);
        return $query->getResult();
    }

    public function updateSKMutasi($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_mutasi');
        $builder->where($where);
        $builder->update($data);
    }

    public function getDetailMutasi($where)
    {
        $db = db_connect();
        $builder = $db->table('mutasi_pegawai');
        $builder->select('id_mutasi_pegawai, mutasi_pegawai.id_mutasi, no_sk, tgl_mutasi, unit_asal, unit_tujuan, status_mutasi, tb_pegawai.id_pegawai, nip, tb_user.nama');
        $builder->join('tb_mutasi', 'tb_mutasi.id_mutasi = mutasi_pegawai.id_mutasi');
        $builder->join('tb_pegawai', 'tb_pegawai.id_pegawai = mutasi_pegawai.id_pegawai');
        $builder->join('tb_user', 'tb_pegawai.id_pegawai = tb_user.id_user');
        $query = $builder->getWhere($where);

        return $query->getResult();
    }

    public function updateDataMutasi($where, $data)
    {
        $db = db_connect();
        $builder = $db->table("mutasi_pegawai");
        $builder->where($where);
        $builder->update($data);
    }

    public function insertDataSKMutasi($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_mutasi');
        $builder->insert($data);
    }

    public function insertDataMutasi($data)
    {
        $db = db_connect();
        $builder = $db->table('mutasi_pegawai');
        $builder->insert($data);
    }

    public function deleteMutasi($where)
    {
        $db = db_connect();
        $builder = $db->table('mutasi_pegawai');
        $builder->delete($where);
    }
}