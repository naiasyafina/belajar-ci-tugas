<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\DiscountModel;

class DiscountController extends ResourceController
{
    protected $modelName = DiscountModel::class;
    protected $format    = 'json';

    // GET /api/discount
    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $perPage = $this->request->getGet('per_page') ?? 10;

        $data = $this->model
            ->paginate($perPage, 'default', $page);

        return $this->respond([
            'data' => $data,
            'pager' => [
                'currentPage' => $page,
                'perPage' => $perPage,
                'total' => $this->model->pager->getTotal()
            ]
        ]);
    }

    // GET /api/discount/1
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        return $this->respond($data);
    }

    // POST /api/discount
    public function create()
    {
        $data = $this->request->getJSON(true);

        $this->model->insert($data);

        return $this->respondCreated([
            'message' => 'Diskon berhasil ditambahkan'
        ]);
    }

    // PUT /api/discount/1
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $this->model->update($id, $data);

        return $this->respond([
            'message' => 'Diskon berhasil diubah'
        ]);
    }

    // DELETE /api/discount/1
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'message' => 'Diskon berhasil dihapus'
        ]);
    }
}