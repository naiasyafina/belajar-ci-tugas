<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class PembelianController extends BaseController
{
    protected $transactionModel;
    protected $transactionDetailModel;

    public function __construct()
    {
        // helper yang dipakai di view
        helper(['form', 'number']);

        $this->transactionModel = new TransactionModel();
        $this->transactionDetailModel = new TransactionDetailModel();
    }

    public function index()
    {
        // hanya admin
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url());
        }

        $transactions = $this->transactionModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $transactionIds = array_column($transactions, 'id');

        $products = $this->transactionDetailModel
            ->getProductsByTransactionIds($transactionIds);

        $data = [
            'transactions' => $transactions,
            'products'     => $products
        ];

        return view('pembelian/index', $data);
    }

    public function update($id)
    {
        // hanya admin
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url());
        }

        $status = $this->request->getPost('status');

        $this->transactionModel->update($id, [
            'status' => $status
        ]);

        session()->setFlashdata(
            'success',
            'Status pesanan berhasil diubah.'
        );

        return redirect()->to(base_url('pembelian'));
    }
}