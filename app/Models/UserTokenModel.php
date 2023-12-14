<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTokenModel extends Model
{
    protected $table = 'user_token';
    protected $useTimestamps = false;
    protected $allowedFields = ['email', 'token', 'created_at'];

    public function getUserToken($token)
    {
        return $this->where([
            'token' => $token,
        ])->first();
    }
}
