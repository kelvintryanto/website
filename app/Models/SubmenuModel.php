<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmenuModel extends Model
{
    protected $table = 'user_sub_menu';
    protected $useTimestamps = false;
    protected $allowedFields = ['menu_id', 'title', 'url', 'icon', 'is_active'];

    public function getSubmenu($id)
    {
        return $this->where(['id' => $id])->first();
    }
}
