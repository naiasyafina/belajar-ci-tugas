<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if(session()->getFlashdata('success')) : ?>
<div class="alert alert-success alert-dismissible fade show">
    <?= session()->getFlashdata('success') ?>
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<table class="table datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>User</th>
            <th>Total</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($transactions as $i=>$trx): ?>

        <tr>

            <td><?= $i+1 ?></td>

            <td><?= $trx['id'] ?></td>

            <td><?= $trx['username'] ?></td>

            <td><?= number_to_currency($trx['total_harga'],'IDR') ?></td>

            <td><?= $trx['alamat'] ?></td>

            <td>

                <?php if($trx['status']==0): ?>

                    <span class="badge bg-warning">
                        Belum Selesai
                    </span>

                <?php else: ?>

                    <span class="badge bg-success">
                        Sudah Selesai
                    </span>

                <?php endif; ?>

            </td>

            <td>

                <button
                    class="btn btn-info btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#detailModal<?= $trx['id'] ?>">
                    Detail
                </button>

                <button
                    class="btn btn-success btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editModal<?= $trx['id'] ?>">
                    Ubah Status
                </button>

            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

<?= $this->include('pembelian/modal_detail') ?>
<?= $this->include('pembelian/modal_edit') ?>

<?= $this->endSection() ?>