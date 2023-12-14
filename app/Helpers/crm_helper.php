<?php

use CodeIgniter\HTTP\URI;

function is_logged_in()
{
    $user = session()->get('userdata');
    $uri = service('uri');
    $db = db_connect();
    $user_menu = $db->table('user_menu');

    if (!$user != null) {
        return redirect()->to(base_url() . '/auth');
    } else {
        $role_id = $user['role_id'];
        $menu = $uri->getSegment(1);

        $queryMenu = $user_menu->getWhere(['menu' => $menu])->getRowArray();
        if ($queryMenu == null) {
            $data = [
                'title'             => 'nO uRL FOUND',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            echo view('/noURL', $data);
        } else {
            $menu_id = $queryMenu['id'];
        }


        $userAccessMenu = $db->query("SELECT `role_id`,`menu_id` 
                                FROM `user_access_menu`
                               WHERE `role_id`= $role_id AND `menu_id`= $menu_id")->getResultArray();

        // dd($userAccessMenu);

        if (empty($userAccessMenu) == true) {
            $user = session()->get('userdata');
            $data = [
                'title'             => 'Blocked',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            echo view('/blocked', $data);
        }
    };
}

// function ini untuk menampilkan checked dan tidak
function check_access($role_id, $menu_id)
{
    $db = db_connect();

    $queryRole = $db->query("SELECT * 
                               FROM `user_access_menu`
                              WHERE `role_id`= $role_id AND `menu_id`= $menu_id")->getRowArray();

    if ($queryRole > 0) {
        return "checked";
    }
}

//function ini untuk membuat format rupiah dengan PHP
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, '.', ',');
    return $hasil_rupiah;
}

// function ini untuk membuat format uang secara otomatis
function uang($angka)
{
    $hasil_uang = number_format($angka, 0, '.', ',');
    return $hasil_uang;
}

