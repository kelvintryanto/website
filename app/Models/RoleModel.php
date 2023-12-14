<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'user_role';
    protected $useTimestamps = false;
    protected $allowedFields = ['role'];

    public function getRole($id)
    {
        return $this->where(['id' => $id])->first();
    }
}
