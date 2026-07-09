<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\DiscountModel;

class Home extends BaseController
{
    protected $productModel;
    protected $discountModel;

    public function __construct()
    {
        helper(['number', 'form']);

        $this->productModel = new ProductModel();
        $this->discountModel = new DiscountModel();
    }

    public function index(): string
    {
        $products = $this->productModel->findAll();

        // Ambil diskon berdasarkan tanggal hari ini
        $discount = $this->discountModel->getTodayDiscount();

        $data = [
            'products' => $products,
            'discount' => $discount
        ];

        return view('v_home', $data);
    }
}