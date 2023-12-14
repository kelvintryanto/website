<?php

namespace App\Models;

use CodeIgniter\Model;

class IncomeModel extends Model
{
    protected $table = 'user_income';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_id', 'keterangan', 'nominal', 'category_id'];

    public function getTotalIncome($user_id)
    {
        $totalincome =  $this->selectSum('nominal')->where('user_id', $user_id)->first();
        return $totalincome['nominal'];
    }
}
