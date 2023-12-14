<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['fullname', 'email', 'password', 'profile_picture', 'role_id', 'is_active'];

    public function getUser($email)
    {
        return $this->where([
            'email' => $email,
            // 'password' => $password
        ])->first();
    }
}
