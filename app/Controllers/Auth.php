<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\UserTokenModel;

class Auth extends BaseController
{
    protected $userModel, $userTokenModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'WPU Login',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function login()
    {
        if (!$this->validate([
            'email' =>
            [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required'      => 'Email harus diisi',
                    'valid_email'   => 'isi dengan alamat email yang benar'
                ]
            ],
            'password' =>
            [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Password harus diisi',
                ]
            ],
        ])) {
            return redirect()->to(base_url() . '/auth/index')->withInput();
        }

        // setelah berhasil divalidate, bandingkan dengan data yang ada di database
        // masuk ke method _login();
        // echo 'Berhasil login!';
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->userModel->getUser($email);

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $user = $this->userModel->getUser($email);
                    session()->set('userdata', $user);
                    if ($user['role_id'] == 1) {
                        // untuk menu admin > role_id nya 1
                        return redirect()->to(base_url() . '/admin');
                    } else {
                        // untuk menu user > role_id nya 2
                        return redirect()->to(base_url() . '/user');
                    }
                } else {
                    session()->setFlashdata('pesan-danger', 'Wrong Password!');
                    return redirect()->to(base_url() . '/auth/index')->withInput();
                }
            } else {
                session()->setFlashdata('pesan-danger', 'This Email has not been activated!');
                return redirect()->to(base_url() . '/auth/index')->withInput();
            }
        } else {
            session()->setFlashdata('pesan-danger', 'Email is not registered!');
            return redirect()->to(base_url() . '/auth/index')->withInput();
        }
    }

    public function registration()
    {
        // session();
        $data = [
            'title' => 'WPU User Registration',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/registration', $data);
    }

    public function save()
    {
        $this->userTokenModel = new UserTokenModel();
        // session();
        if (!$this->validate([
            'fullname' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama user harus diisi'
                ]
            ],
            'email' =>
            [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required'      => 'Email harus diisi',
                    'valid_email'   => 'isi dengan alamat email yang benar',
                    'is_unique'     => 'email sudah teregistrasi'
                ]
            ],
            'password' =>
            [
                'rules'     => 'required|min_length[6]|matches[confirmpassword]',
                'errors'    => [
                    'required'      => 'Password harus diisi',
                    'min_length'    => 'Panjang password minimal 6 character',
                    'matches'       => 'Confirm Password dengan Password harus sama'
                ]
            ],
            'confirmpassword' =>
            [
                'rules' => 'required|min_length[6]|matches[password]',
                'errors' => [
                    'required'      => 'Confirm Password harus diisi',
                    'min_length'    => 'Panjang password minimal 6 character',
                    'matches'       => 'Confirm Password dengan Password harus sama'
                ]
            ],
        ])) {

            return redirect()->to(base_url() . '/auth/registration')->withInput();
        }

        $email = $this->request->getVar('email');
        $this->userModel->save([
            'fullname' => $this->request->getVar('fullname'),
            'email' => $email,
            'profile_picture' => 'default.jpg',
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 0
        ]);

        // siapkan token 
        $token = base64_encode(random_bytes(32));

        $user_token = [
            'email' => $email,
            'token' => $token,
            'created_at' => time()
        ];

        $this->userTokenModel->save($user_token);

        $this->_sendEmail($email, $token, 'verify');

        session()->setFlashdata('pesan', 'Berhasil Registrasi! Silakan aktivasi email Anda!');
        return redirect()->to(base_url() . '/');
    }

    private function _sendEmail($emailPenerima, $token, $type)
    {
        $this->userModel = new UserModel();
        // pakai config ini untuk kirim email
        $email = \Config\Services::email();

        $email->setTo($emailPenerima);

        $email->setSubject('Account Verification');

        // untuk verify pakai yang ini nanti forgot password tinggal tambahkan else
        if ($type == 'verify') {
            $email->setMessage('Click this link to verify your account : <a href="' . base_url() . '/auth/verify?email=' . $this->request->getVar('email') . '&token=' . urlencode($token) . '">Activate</a>!');
        }

        if ($email->send()) {
            return true;
        } else {
            echo $email->printDebugger();
            die;
        }
    }

    public function verify()
    {
        $this->userTokenModel = new UserTokenModel();
        $this->userModel = new UserModel();

        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        // dd($token);

        $user = $this->userModel->getUser($email);

        if ($user) {
            $user_token = $this->userTokenModel->getUserToken($token);

            if ($user_token) {
                if (time() - $user_token['created_at'] < (60 * 60 * 24)) {
                    $this->userModel->save([
                        'id'    => $user['id'],
                        'is_active' => 1
                    ]);

                    $this->userTokenModel->delete($user_token['id']);

                    session()->setFlashdata('pesan', 'Account Activation Succeed');
                    return redirect()->to(base_url() . '/');
                } else {
                    session()->setFlashdata('pesan-danger', 'Token Expired!');
                    return redirect()->to(base_url() . '/');

                    $this->userModel->delete($user['id']);
                    $this->userTokenModel->delete($user_token['id']);

                    session()->setFlashdata('pesan-danger', 'Data dihapus');
                    return redirect()->to(base_url() . '/');
                }
            } else {
                session()->setFlashdata('pesan-danger', 'Token Invalid! Please Retry!');
                return redirect()->to(base_url() . '/');
            }
        } else {
            session()->setFlashdata('pesan-danger', 'Account Activation Failed! Please Retry!');
            return redirect()->to(base_url() . '/');
        }
    }
}
