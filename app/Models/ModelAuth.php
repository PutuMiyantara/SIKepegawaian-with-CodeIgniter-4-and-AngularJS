<?php

namespace App\Models;

use CodeIgniter\Database\Query;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function getUser($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_user');
        $builder->select('id_user, email, password, role, status, nama, foto');
        $query = $builder->getWhere(['email' => $email])->getRowArray();
        return $query;
    }
}