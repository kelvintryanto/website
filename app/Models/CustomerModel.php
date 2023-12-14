<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $useTimestamps = true;
    protected $allowedFields =
    [
        'nama',
        'noHP',
        'email',
        'profile_picture',
        'jenisKelamin',
        'tempatLahir',
        'tanggalLahir',
        'tinggiBadan',
        'beratBadan',
        'statusPerokok',
        'pekerjaan',
        'alamatKerja',
        'alamatRumah',
        'agama',
        'golonganDarah',
        'userID'
    ];
}
