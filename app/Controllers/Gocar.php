<?php

namespace App\Controllers;

class Gocar extends BaseController
{
    public function __construct()
    {
        is_logged_in();
    }

    public function trip()
    {
        $user = session()->get('userdata');

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Gocar Trip',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $id = $user['id'];
            // kembalikan data ke dalam login
            return view('gocar/trip', $data);
        }
    }
}
