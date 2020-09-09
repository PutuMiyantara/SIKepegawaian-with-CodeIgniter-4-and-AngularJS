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
        $builder->select('email, nama, nip, nama_pangkat, nama_jabatan, tgl_lahir, tgl_pensiun, role, status, tempat_bekerja');
        $builder->join('tb_pangkat', 'tb_pangkat.id_pangkat = tb_pegawai.id_pangkat');
        $builder->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_pegawai.id_jabatan');
        $builder->join('tb_user', 'tb_user.id_user = tb_pegawai.id_pegawai');
        $query = $builder->getWhere($where);
        return $query->getResult();
    }

    public function getdataPegs()
    {
        $db = db_connect();
        $builder = $db->table('tb_pegawai');
        $builder->select('id_pegawai, email, status, tgl_pensiun, nip, nama, tgl_lahir, nama_pangkat, nama_jabatan, tempat_bekerja');
        $builder->join('tb_pangkat', 'tb_pangkat.id_pangkat = tb_pegawai.id_pangkat');
        $builder->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_pegawai.id_jabatan');
        $builder->join('tb_user', 'tb_user.id_user = tb_pegawai.id_pegawai');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getPesan($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_pesan');
        $builder->select('*');
        $query = $builder->getWhere($where);
        return $query->getResult();
    }

    public function getDataPesan()
    {
        $db = db_connect();
        $builder = $db->table('tb_pesan');
        $builder->select('id_pesan,email, nama, nip, jenis, tb_pesan.status, tgl_pesan');
        $builder->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pesan.id_pegawai');
        $builder->join('tb_user', 'tb_user.id_user = tb_pegawai.id_pegawai');
        $query = $builder->get();
        return $query->getResult();
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_pesan');
        $builder->where($where);
        $builder->update($data);
    }

    public function deletePesan($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_pesan');
        $builder->delete($where);
    }
}