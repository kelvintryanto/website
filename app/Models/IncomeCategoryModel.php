<?php

namespace App\Models;

use CodeIgniter\Model;

class IncomeCategoryModel extends Model
{
    protected $table = 'user_income_category';
    protected $useTimestamps = false;
    protected $allowedFields = ['user_id', 'category'];

    public function getCategory($id)
    {
        return $this->where(['id' => $id])->first();
    }
}
