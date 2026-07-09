<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiscountModel;

class DiscountController extends BaseController
{
    protected $discountModel;

    public function __construct()
    {
        helper('form');
        $this->discountModel = new DiscountModel();
    }

    public function index()
    {
        return view('discount/index', [
            'discounts' => $this->discountModel->findAll(),
            'validation' => \Config\Services::validation()
        ]);
    }

    public function create()
    {
        $rules = [
            'tanggal' => [
                'rules' => 'required|is_unique[discount.tanggal]',
                'errors' => [
                    'required' => 'Tanggal wajib diisi.',
                    'is_unique' => 'Tanggal tersebut sudah memiliki diskon.'
                ]
            ],
            'nominal' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('discount')->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->discountModel->insert([
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal')
        ]);

        return redirect()->to('discount')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $this->discountModel->update($id, [
            'nominal' => $this->request->getPost('nominal')
        ]);

        return redirect()->to('discount')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $this->discountModel->delete($id);

        return redirect()->to('discount')->with('success', 'Data berhasil dihapus');
    }
}