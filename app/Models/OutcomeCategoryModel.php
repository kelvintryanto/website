<?php

namespace App\Models;

use CodeIgniter\Model;

class OutcomeCategoryModel extends Model
{
    protected $table = 'user_outcome_category';
    protected $useTimestamps = false;
    protected $allowedFields = ['user_id', 'category'];

    public function getCategory($id)
    {
        return $this->where(['id' => $id])->first();
    }
}
