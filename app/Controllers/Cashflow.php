<?php

namespace App\Controllers;

use App\Models\IncomeCategoryModel;
use App\Models\OutcomeCategoryModel;
use \App\Models\IncomeModel;
use App\Models\OutcomeModel;

class Cashflow extends BaseController
{
    protected $incomeModel, $incomeCategoryModel;
    protected $outcomeModel, $outcomeCategoryModel;
    protected $user;
    protected $helpers = ['form'];

    public function __construct()
    {
        is_logged_in();
    }

    public function index()
    {
        $user = session()->get('userdata');
        $this->incomeModel = new IncomeModel();
        $this->outcomeModel = new OutcomeModel();

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Cashflow',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $id = $user['id'];
            // kembalikan data ke dalam login
            $data['totalincome'] = $this->incomeModel->getTotalIncome($id);
            $data['totaloutcome'] = $this->outcomeModel->getTotalOutcome($id);
            return view('cashflow/dashboard', $data);
        }
    }

    
    public function io()
    {
        $user = session()->get('userdata');
        $db = db_connect();
        $this->incomeModel = new IncomeModel();
        $this->outcomeModel = new OutcomeModel();

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Income / Outcome',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $id = $user['id'];

            $queryIncome = "SELECT * FROM (
                                SELECT `user_income`.`id`, `user_income`.`user_id`, `user_income`.`keterangan`, `user_income`.`nominal`, `user_income_category`.`category`
                                  FROM `user_income` 
                                  JOIN `user_income_category`
                                    ON `user_income`.`category_id` = `user_income_category`.`id`
                                 WHERE `user_income`.`user_id`=$id 
                              ORDER BY `user_income`.`id` DESC 
                                 LIMIT 10
                                        )A ORDER BY A.`id`";

            $queryOutcome = "SELECT * FROM (
                                SELECT `user_outcome`.`id`, `user_outcome`.`user_id`, `user_outcome`.`keterangan`, `user_outcome`.`nominal`, `user_outcome_category`.`category`
                                  FROM `user_outcome` 
                                  JOIN `user_outcome_category`
                                    ON `user_outcome`.`category_id` = `user_outcome_category`.`id`
                                 WHERE `user_outcome`.`user_id`=$id 
                              ORDER BY `user_outcome`.`id` DESC 
                                 LIMIT 10
                                        )A ORDER BY A.`id`";

            $data['income'] = $db->query($queryIncome)->getResultArray();
            $data['outcome'] = $db->query($queryOutcome)->getResultArray();

            $data['totalincome'] = $this->incomeModel->getTotalIncome($id);
            $data['totaloutcome'] = $this->outcomeModel->getTotalOutcome($id);

            $data['income_category'] = $db->query("SELECT * FROM `user_income_category` WHERE `user_id`=$id")->getResultArray();
            $data['outcome_category'] = $db->query("SELECT * FROM `user_outcome_category` WHERE `user_id`=$id")->getResultArray();

            // kembalikan data ke dalam login
            return view('cashflow/io', $data);
        }
    }

    public function addincome()
    {
        $user = session()->get('userdata');
        $this->incomeModel = new IncomeModel();

        if (!$this->validate([
            'keterangan' =>
            [
                'keterangan' => 'required',
                'errors' => [
                    'required' => 'keterangan perlu diisi'
                ]
            ],
            'nominal' =>
            [
                'nominal' => 'required',
                'errors' => [
                    'required' => 'nominal perlu diisi'
                ]
            ],
            'category' =>
            [
                'category' => 'required',
                'errors' => [
                    'required' => 'category perlu diisi'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/cashflow/io')->withInput();
        } else {
            // dd($time);
            $this->incomeModel->save([
                'user_id'       => $user['id'],
                'keterangan'    => $this->request->getVar('keterangan'),
                'nominal'       => $this->request->getVar('nominal'),
                'category_id'   => $this->request->getVar('category')
            ]);

            session()->setFlashdata('pesan-income', 'Income Berhasil ditambahkan');
            return redirect()->to(base_url() . '/cashflow/io');
        }
    }

    public function addoutcome()
    {
        $user = session()->get('userdata');
        $this->outcomeModel = new OutcomeModel();

        if (!$this->validate([
            'keterangan' =>
            [
                'keterangan' => 'required',
                'errors' => [
                    'required' => 'keterangan perlu diisi'
                ]
            ],
            'nominal' =>
            [
                'nominal' => 'required',
                'errors' => [
                    'required' => 'nominal perlu diisi'
                ]
            ],
            'category' =>
            [
                'category' => 'required',
                'errors' => [
                    'required' => 'category perlu diisi'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/cashflow/io')->withInput();
        } else {
            // dd($time);
            $this->outcomeModel->save([
                'user_id'       => $user['id'],
                'keterangan'    => $this->request->getVar('keterangan'),
                'nominal'       => $this->request->getVar('nominal'),
                'category_id'   => $this->request->getVar('category')
            ]);

            session()->setFlashdata('pesan-outcome', 'Outcome Berhasil ditambahkan');
            return redirect()->to(base_url() . '/cashflow/io');
        }
    }




    // menampilkan page category (READ INCOME CATEGORY & OUTCOME CATEGORY)
    public function category()
    {
        $user = session()->get('userdata');
        $db = db_connect();

        if ($user == null) {
            return redirect()->to(base_url() . '/auth/index');
        } else {
            // harus pakai data karena harus masukin title
            $data = [
                'title'             => 'Cashflow Category',
                'email'             => $user['email'],
                'fullname'          => $user['fullname'],
                'profile_picture'   => $user['profile_picture'],
                'role_id'           => $user['role_id'],
                'created_at'        => $user['created_at']
            ];
            $id = $user['id'];

            // masukin jumlah category yang dipakai oleh income/outcome
            $data['income_category'] = $db->query(
                "SELECT `user_income_category`.`id`, `user_income_category`.`category`, `user_income`.`ti` 
                   FROM `user_income_category` 
              LEFT JOIN (
                        SELECT `category_id`, COUNT(*) as `ti` 
                        FROM `user_income` 
                        GROUP BY `category_id`)`user_income`
                     ON `user_income_category`.`id` = `user_income`.`category_id`
                  WHERE `user_id`=$id"
            )->getResultArray();

            // masukin jumlah category yang dipakai dalam income/outcome
            $data['outcome_category'] = $db->query(
                "SELECT `user_outcome_category`.`id`, `user_outcome_category`.`category`, `user_outcome`.`to` 
                                                      FROM `user_outcome_category` 
                                                 LEFT JOIN (
                                                            SELECT `category_id`, COUNT(*) as `to` 
                                                            FROM `user_outcome` 
                                                            GROUP BY `category_id`)`user_outcome`
                                                        ON `user_outcome_category`.`id` = `user_outcome`.`category_id`
                                                     WHERE `user_id`=$id"
            )->getResultArray();

            return view('cashflow/category', $data);
        }
    }


    // INCOME CATEGORY
    // menambahkan incomecategory
    public function addincomecategory()
    {
        $user = session()->get('userdata');
        $this->incomeCategoryModel = new IncomeCategoryModel();

        if (!$this->validate([
            'category' =>
            [
                'category' => 'required',
                'errors' => [
                    'required' => 'category perlu diisi'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/cashflow/category')->withInput();
        } else {
            // dd($time);
            $this->incomeCategoryModel->save([
                'user_id'       => $user['id'],
                'category'      => $this->request->getVar('category')
            ]);

            session()->setFlashdata('pesan-income', 'Income Category Berhasil ditambahkan');
            return redirect()->to(base_url() . '/cashflow/category');
        }
    }

    // update income category
    public function updateincomecategory($id)
    {
        $this->incomeCategoryModel = new IncomeCategoryModel();
        $incomeCategoryLama = $this->incomeCategoryModel->getCategory($id);

        if (!$this->validate([
            'incomeCategory' =>
            [
                'incomeCategory' => 'required',
                'errors' => [
                    'required' => 'Category perlu diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan-danger', validation_show_error('incomeCategory'));
            return redirect()->to(base_url() . '/cashflow/category');
        } elseif ($incomeCategoryLama['category'] != $this->request->getVar('incomeCategory')) {
            $this->incomeCategoryModel->save([
                'id'    => $this->request->getVar('id'),
                'category'  => $this->request->getVar('incomeCategory')
            ]);

            session()->setFlashdata('pesan-income', 'Income Category Berhasil diupdate');
            return redirect()->to(base_url() . '/cashflow/category');
        } else {
            session()->setFlashdata('pesan-income', 'Tidak ada update');
            return redirect()->to(base_url() . '/cashflow/category');
        }
    }

    // delete category income
    public function deleteincomecategory($id)
    {
        // periksa apakah kategori dipakai dalam income dan outcome
        $db = db_connect();
        $queryIOCategory = "SELECT * FROM `user_income`
                                    WHERE `category_id`=$id";

        // jika tidak dipakai ya hapus
        if ($db->query($queryIOCategory)->getNumRows() < 1) {
            // untuk delete menu utamanya
            $this->incomeCategoryModel = new IncomeCategoryModel();
            $this->incomeCategoryModel->delete($id);

            session()->setFlashdata('pesan-income', 'Delete Success');
            return redirect()->to(base_url() . '/cashflow/category');
        } else {
            session()->setFlashdata('pesan-danger-income', 'Data Category is used, cannot Delete!');
            return redirect()->to(base_url() . '/cashflow/category');
        }
    }


    // OUTCOME CATEGORY
    // menambahkan outcome category
    public function addoutcomecategory()
    {
        $user = session()->get('userdata');
        $this->outcomeCategoryModel = new OutcomeCategoryModel();

        if (!$this->validate([
            'category' =>
            [
                'category' => 'required',
                'errors' => [
                    'required' => 'category perlu diisi'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/cashflow/category')->withInput();
        } else {
            // dd($time);
            $this->outcomeCategoryModel->save([
                'user_id'       => $user['id'],
                'category'      => $this->request->getVar('category')
            ]);

            session()->setFlashdata('pesan-outcome', 'Outcome Category Berhasil ditambahkan');
            return redirect()->to(base_url() . '/cashflow/category');
        }
    }

    // update outcome category
    public function updateoutcomecategory($id)
    {
        $this->outcomeCategoryModel = new OutcomeCategoryModel();
        $outcomeCategoryLama = $this->outcomeCategoryModel->getCategory($id);

        if (!$this->validate([
            'outcomeCategory' =>
            [
                'outcomeCategory' => 'required',
                'errors' => [
                    'required' => 'outcomeCategory perlu diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan-danger', validation_show_error('outcomeCategory'));
            return redirect()->to(base_url() . '/cashflow/category');
        } elseif ($outcomeCategoryLama['category'] != $this->request->getVar('outcomeCategory')) {
            $this->outcomeCategoryModel->save([
                'id'    => $this->request->getVar('id'),
                'category'  => $this->request->getVar('outcomeCategory')
            ]);

            session()->setFlashdata('pesan-outcome', 'Outcome Category Berhasil diupdate');
            return redirect()->to(base_url() . '/cashflow/category');
        } else {
            session()->setFlashdata('pesan-outcome', 'Tidak ada update');
            return redirect()->to(base_url() . '/cashflow/category');
        }
    }

    // delete outcome category
    public function deleteoutcomecategory($id)
    {
        // periksa apakah kategori dipakai dalam income dan outcome
        $db = db_connect();
        $queryIOCategory = "SELECT * FROM `user_outcome`
                                    WHERE `category_id`=$id";

        // jika tidak dipakai ya hapus
        if ($db->query($queryIOCategory)->getNumRows() < 1) {
            // untuk delete menu utamanya
            $this->outcomeCategoryModel = new OutcomeCategoryModel();
            $this->outcomeCategoryModel->delete($id);

            session()->setFlashdata('pesan-outcome', 'Delete Success');
            return redirect()->to(base_url() . '/cashflow/category');
        } else {
            session()->setFlashdata('pesan-danger-outcome', 'Data Category is used, cannot Delete!');
            return redirect()->to(base_url() . '/cashflow/category');
        }
    }
}
