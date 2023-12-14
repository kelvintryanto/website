<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public $roleModel, $userModel;
    protected $helpers = ['form'];
    protected $user;

    public function __construct()
    {
        is_logged_in();
    }

    public function index()
    {
        // is_logged_in();
        $user = session()->get('userdata');

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'User Login',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            // kembalikan data ke dalam login
            return view('admin/index', $data);
        }
    }

    public function role()
    {
        // is_logged_in();
        $user = session()->get('userdata');
        $db = db_connect();

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Role Access Management',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $data['role'] = $db->query("SELECT * FROM `user_role`")->getResultArray();
            return view('admin/role', $data);
        }
    }

    public function roleAccess($role_id)
    {
        $user = session()->get('userdata');
        $db = db_connect();

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Role Access Management',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $data['role'] = $db->query("SELECT * FROM `user_role` WHERE `id`=$role_id")->getRowArray();
            $data['menu'] = $db->query("SELECT * FROM `user_menu` WHERE `id`!=1")->getResultArray();
            return view('admin/roleaccess', $data);
        }
    }

    public function addrole()
    {
        $this->roleModel = new RoleModel();

        if (!$this->validate([
            'role' =>
            [
                'role' => 'required',
                'errors' => [
                    'required' => 'Role perlu diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan-danger', validation_show_error('role'));
            return redirect()->to(base_url() . '/admin/role');
        } else {
            $this->roleModel->save([
                'role' => $this->request->getVar('role')
            ]);

            session()->setFlashdata('pesan', 'Role Berhasil ditambahkan');
            return redirect()->to(base_url() . '/admin/role');
        }
    }

    // function ini untuk mengganti akses dalam role
    public function changeaccess()
    {
        $db = db_connect();
        $user_access_menu = $db->table('user_access_menu');

        $menu_id = $this->request->getVar('menuId');
        $role_id = $this->request->getVar('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $user_access_menu->getWhere($data)->getRowArray();

        if ($result < 1) {
            $user_access_menu->insert($data);
        } else {
            $user_access_menu->delete($data);
        }

        session()->setFlashdata('pesan', 'Access Changed!');
    }

    public function userrole()
    {
        $user = session()->get('userdata');
        $db = db_connect();

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'User Role',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $data['role'] = $db->query("SELECT * FROM `user_role`")->getResultArray();
            $data['user_list'] = $db->query("SELECT `id`,`fullname`, `profile_picture`, `role_id`, `is_active`
                                               FROM `user`
                                            GROUP BY `role_id` ASC")->getResultArray();
            // $data['menu'] = $db->query("SELECT * FROM `user_menu` WHERE `id`!=1")->getResultArray();
            return view('admin/userrole', $data);
        }
    }

    public function change_role()
    {
        $this->userModel = new UserModel();

        $role_id = $this->request->getVar('roleId');
        $user_id = $this->request->getVar('userId');

        $data = [
            'id' => $user_id,
            'role_id' => $role_id
        ];

        $this->userModel->save($data);

        session()->setFlashdata('pesan', 'Role Changed!');
        return redirect()->to(base_url() . '/admin/userrole');
    }

    public function logout()
    {
        session()->remove('userdata');

        session()->setFlashdata('pesan-danger', 'You have been logged out!');
        return redirect()->to(base_url() . '/auth/index')->withInput();
    }
}
