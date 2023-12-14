<?php

namespace App\Models;

use CodeIgniter\Model;

class OutcomeModel extends Model
{
    protected $table = 'user_outcome';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_id', 'keterangan', 'nominal', 'category_id'];

    public function getTotalOutcome($user_id)
    {
        $totaloutcome =  $this->selectSum('nominal')->where('user_id', $user_id)->first();
        return $totaloutcome['nominal'];
    }
}
