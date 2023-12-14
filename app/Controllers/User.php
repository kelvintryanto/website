<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;
    protected $user;
    protected $helpers = ['form'];

    public function __construct()
    {
        is_logged_in();
    }

    public function index()
    {
        $user = session()->get('userdata');

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'User Profile',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            // kembalikan data ke dalam login
            return view('user/index', $data);
        }
    }

    public function edit()
    {
        $user = session()->get('userdata');

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Edit Profile',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];

            // kembalikan data ke dalam login
            return view('user/edit', $data);
        }
    }

    public function update()
    {
        $user = session()->get('userdata');
        $this->userModel = new UserModel();

        if (!$this->validate([
            'fullname' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'profilepicture' => [
                'rules' => 'max_size[profilepicture,1024]|is_image[profilepicture]|mime_in[profilepicture,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => ' Yang anda pilih bukan gambar',
                    'mime_in' => ' Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/user/edit/')->withInput();
        };

        // ambil gambar
        $fileProfilePicture = $this->request->getFile('profilepicture');

        // cek gambar, apakah tetap gambar lama
        if ($fileProfilePicture->getError() == 4) {
            $profilePicture = $this->request->getVar('profilLama');
        } else {
            // generate nama sampul random
            $profilePicture = $fileProfilePicture->getRandomName();
            // pindahkan gambar
            $fileProfilePicture->move('assets/img/profile', $profilePicture);

            if ($this->request->getVar('profilLama') != "default.jpg") {
                // hapus link yang lama supaya folder di dalam profil tidak menumpuk

                unlink('assets/img/profile/' . $this->request->getVar('profilLama'));
            }
        }

        // dd($data);
        $this->userModel->save([
            'id'                => $user['id'],
            'fullname'          => $this->request->getVar('fullname'),
            'profile_picture'   => $profilePicture
        ]);

        // hapus dulu session sebelumnya
        session()->remove('userdata');
        // tempelkan session yang baru
        $user = $this->userModel->getUser($user['email']);
        session()->set('userdata', $user);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(base_url() . '/user/index');
    }

    public function logout()
    {
        session()->remove('userdata');

        session()->setFlashdata('pesan-danger', 'You have been logged out!');
        return redirect()->to(base_url() . '/auth/index')->withInput();
    }

    // tampilkan page change password
    public function changepassword()
    {
        $user = session()->get('userdata');

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Change Password',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];

            // kembalikan data ke dalam login
            return view('user/changepassword', $data);
        }
    }

    // updatepassword
    public function updatepassword()
    {
        $user = session()->get('userdata');
        $this->userModel = new UserModel();

        if (!$this->validate([
            'currentpassword' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Current Password perlu diisi'
                ]
            ],
            'password' =>
            [
                'rules' => 'required|min_length[6]|matches[repeatpassword]',
                'errors' => [
                    'required'      => 'password perlu diisi',
                    'min_length'    => 'Panjang password minimal 6 character',
                    'matches'       => 'Repeat Password dengan Password harus sama'
                ]
            ],
            'repeatpassword' =>
            [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required'      => 'Repeat Password perlu diisi',
                    'min_length'    => 'Panjang password minimal 6 character',
                ]
            ],
        ])) {
            return redirect()->to(base_url() . '/user/changepassword')->withInput();
        } else {
            // ambil password pada input
            $currentPassword = $this->request->getVar('currentpassword');
            $newPassword = $this->request->getVar('password');

            // cocokkan ke database
            if (!password_verify($currentPassword, $user['password'])) {
                session()->setFlashdata('pesan-danger', 'Wrong Current Password');
                return redirect()->to(base_url() . '/user/changepassword');
            } else {
                // kalau newpassword sama dengan old password
                if ($currentPassword == $newPassword) {
                    session()->setFlashdata('pesan-danger', 'New Password cannot be the same with Current Password!');
                    return redirect()->to(base_url() . '/user/changepassword');
                } else {
                    // password sudah ok
                    // dd($user['id']);
                    $this->userModel->save([
                        'id'            => $user['id'],
                        'password'      => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                    ]);

                    session()->setFlashdata('pesan', 'Berhasil Update Password!');
                    return redirect()->to(base_url() . '/user/changepassword');
                }
            }
        }
    }
}
