<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'user_menu';
    protected $useTimestamps = false;
    protected $allowedFields = ['menu'];

    public function getMenu($id)
    {
        return $this->where(['id' => $id])->first();
    }
}
