<?php

namespace App\Controllers;

use \App\Models\MenuModel;
use \App\Models\SubmenuModel;


class Menu extends BaseController
{
    public $menuModel, $submenuModel;
    protected $helpers = ['form'];
    protected $user;

    public function __construct()
    {
        is_logged_in();
    }

    // READ
    public function index()
    {
        $user = session()->get('userdata');
        $db = db_connect();

        if ($user == null) {
            return redirect()->to(base_url() . '/auth');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Menu Management',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $data['menu'] = $db->query("SELECT * FROM `user_menu`")->getResultArray();
            // kembalikan data ke dalam login
            return view('menu/index', $data);
        }
    }

    public function submenu()
    {
        $user = session()->get('userdata');
        $db = db_connect();

        if ($user == null) {
            return redirect()->to(base_url() . '/auth');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'SubMenu Management',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $data['menu'] = $db->query("SELECT * FROM `user_menu`")->getResultArray();

            $querySubMenu = "SELECT `user_sub_menu`.`id`,`user_sub_menu`.`menu_id`,`user_menu`.`menu`,`user_sub_menu`.`title`,`user_sub_menu`.`url`,`user_sub_menu`.`icon`,`user_sub_menu`.`is_active`
                               FROM `user_sub_menu` 
                               JOIN `user_menu` 
                                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                           ORDER BY `user_sub_menu`.`menu_id`, `user_sub_menu`.`id`";

            $data['submenu'] = $db->query($querySubMenu)->getResultArray();
            // kembalikan data ke dalam login
            return view('submenu/index', $data);
        }
    }

    // CREATE
    public function addmenu()
    {
        $this->menuModel = new MenuModel();

        if (!$this->validate([
            'menu' =>
            [
                'menu' => 'required',
                'errors' => [
                    'required' => 'Menu title perlu diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan-danger', validation_show_error('menu'));
            return redirect()->to(base_url() . '/menu');
        } else {
            $this->menuModel->save([
                'menu' => $this->request->getVar('menu'),
            ]);

            session()->setFlashdata('pesan', 'Menu Berhasil ditambahkan');
            return redirect()->to(base_url() . '/menu');
        }
    }

    public function addsubmenu()
    {
        $this->submenuModel = new SubmenuModel();

        if (!$this->validate([
            'menu' =>
            [
                'menu' => 'required',
                'errors' => [
                    'required' => 'Menu title perlu dipilih'
                ]
            ],
            'submenu' =>
            [
                'submenu' => 'required',
                'errors' => [
                    'required' => 'Submenu perlu diisi'
                ]
            ],
            'url' =>
            [
                'url' => 'required',
                'errors' => [
                    'required' => 'URL perlu diisi'
                ]
            ],
            'icon' =>
            [
                'icon' => 'required',
                'errors' => [
                    'required' => 'icon perlu diisi'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/menu/submenu')->withInput();
        } else {
            // is active = 0 kalau null
            if ($this->request->getVar('isactive')) {
                $is_active = $this->request->getVar('isactive');
            } else {
                $is_active = 0;
            }

            $this->submenuModel->save([
                'menu_id'      => intval($this->request->getVar('menu')),
                'title'        => $this->request->getVar('submenu'),
                'url'          => $this->request->getVar('url'),
                'icon'         => $this->request->getVar('icon'),
                'is_active'    => intval($is_active)
            ]);

            session()->setFlashdata('pesan', 'Submenu Berhasil ditambahkan');
            return redirect()->to(base_url() . '/menu/submenu');
        }
    }

    // UPDATE
    // update menu
    public function update($id)
    {
        $this->menuModel = new MenuModel();
        $menuLama = $this->menuModel->getMenu($id);

        if (!$this->validate([
            'menu' =>
            [
                'menu' => 'required',
                'errors' => [
                    'required' => 'Menu title perlu diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan-danger', validation_show_error('menu'));
            return redirect()->to(base_url() . '/menu');
        } elseif ($menuLama['menu'] != $this->request->getVar('menu')) {
            $this->menuModel->save([
                'id'    => $this->request->getVar('id'),
                'menu'  => $this->request->getVar('menu')
            ]);

            session()->setFlashdata('pesan', 'Menu Berhasil diupdate');
            return redirect()->to(base_url() . '/menu');
        } else {
            session()->setFlashdata('pesan', 'Tidak ada update');
            return redirect()->to(base_url() . '/menu');
        }
    }

    public function updateSubmenu($id)
    {
        $this->submenuModel = new SubmenuModel();
        $submenuLama = $this->submenuModel->getSubmenu($id);

        if (!$this->validate([
            'menu' =>
            [
                'menu' => 'required',
                'errors' => [
                    'required' => 'Menu title perlu diisi'
                ]
            ],
            'title' =>
            [
                'title' => 'required',
                'errors' => [
                    'required' => 'Submenu title perlu diisi'
                ]
            ],
            'url' =>
            [
                'url' => 'required',
                'errors' => [
                    'required' => 'URL perlu diisi'
                ]
            ],
            'icon' =>
            [
                'icon' => 'required',
                'errors' => [
                    'required' => 'Icon perlu diisi'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/menu/submenu')->withInput();
        } elseif (
            $submenuLama['menu_id'] != $this->request->getVar('menu') ||
            $submenuLama['title'] != $this->request->getVar('title') ||
            $submenuLama['url'] != $this->request->getVar('url') ||
            $submenuLama['icon'] != $this->request->getVar('icon') ||
            $submenuLama['is_active'] != $this->request->getVar('is_active')
        ) {
            // is active = 0 kalau null
            if ($this->request->getVar('isactive')) {
                $is_active = $this->request->getVar('isactive');
            } else {
                $is_active = 0;
            }

            $this->submenuModel->save([
                'id'           => $id,
                'menu_id'      => intval($this->request->getVar('menu')),
                'title'        => $this->request->getVar('title'),
                'url'          => $this->request->getVar('url'),
                'icon'         => $this->request->getVar('icon'),
                'is_active'    => intval($is_active)
            ]);
        } else {
            session()->setFlashdata('pesan', 'Tidak ada update');
            return redirect()->to(base_url() . '/menu/menu/submenu');
        }
        session()->setFlashdata('pesan', 'Submenu berhasil diupdate');
        return redirect()->to(base_url() . '/menu/submenu');
    }

    // DELETE
    public function deleteMenu($id)
    {
        // untuk delete sekalian submenu
        $db = db_connect();
        $user_sub_menu = $db->table('user_sub_menu');
        $user_sub_menu->delete(['menu_id' => $id]);

        // untuk delete menu utamanya
        $this->menuModel = new MenuModel();
        $this->menuModel->delete($id);

        session()->setFlashdata('pesan-danger', 'Data berhasil dihapus');
        return redirect()->to(base_url() . '/menu');
    }

    public function deleteSubmenu($id)
    {
        $this->submenuModel = new SubmenuModel();

        $this->submenuModel->delete($id);
        session()->setFlashdata('pesan-danger', 'Data berhasil dihapus');
        return redirect()->to(base_url() . '/menu/submenu');
    }
}
