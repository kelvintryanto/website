<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use \DOMDocument;
use \DOMXPath;

class Customer extends BaseController
{
    protected $customerModel;
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
                'title'             => 'Customer',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $id = $user['id'];
            // kembalikan data ke dalam login
            return view('customer/customer', $data);
        }
    }

    public function addCustomer()
    {
        $user = session()->get('userdata');

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Add Customer',
                'userID'            => $user['id'],
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];

            // kembalikan data ke dalam login
            return view('customer/addcustomer', $data);
        }
    }
}
