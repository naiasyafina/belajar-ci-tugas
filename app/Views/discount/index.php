<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if(session()->getFlashData('success')) : ?>
<div class="alert alert-success alert-dismissible fade show">
    <?= session()->getFlashData('success') ?>
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if(session()->getFlashData('errors')) : ?>
<div class="alert alert-danger">
    <?php foreach(session()->getFlashData('errors') as $error): ?>
        <div><?= $error ?></div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<button class="btn btn-primary mb-3"
        data-bs-toggle="modal"
        data-bs-target="#addModal">
    Tambah Data
</button>

<table class="table datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nominal</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($discounts as $i=>$discount): ?>

        <tr>

            <td><?= $i+1 ?></td>

            <td><?= $discount['tanggal'] ?></td>

            <td>Rp <?= number_format($discount['nominal'], 0, ',', '.') ?></td>

            <td>

                <button class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal-<?= $discount['id'] ?>">
                    Ubah
                </button>

                <a href="<?= base_url('discount/delete/'.$discount['id']) ?>"
                   onclick="return confirm('Yakin hapus data?')"
                   class="btn btn-danger">
                    Hapus
                </a>

            </td>

        </tr>

    <?php endforeach ?>

    </tbody>

</table>

<?= $this->include('discount/modal_add') ?>
<?= $this->include('discount/modal_edit') ?>

<?= $this->endSection() ?>