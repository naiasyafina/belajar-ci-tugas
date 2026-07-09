<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php
}
?>

<?= form_open('keranjang/edit') ?>

<?php if ($discount): ?>
<div class="alert alert-success">
    Diskon Hari Ini :
    <strong><?= number_to_currency($discount['nominal'], 'IDR') ?></strong>
    per produk
</div>
<?php endif; ?>

<table class="table datatable">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Foto</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    <?php
    $i = 1;
    $totalDiskon = 0;

    if (!empty($items)):
        foreach ($items as $item):

            $hargaAsli = $item['price'];

            if ($discount) {
                $harga = max(0, $hargaAsli - $discount['nominal']);
            } else {
                $harga = $hargaAsli;
            }

            $subtotal = $harga * $item['qty'];

            $totalDiskon += $subtotal;
    ?>

        <tr>

            <td><?= $item['name'] ?></td>

            <td>
                <img src="<?= base_url('img/' . $item['options']['foto']) ?>" width="100">
            </td>

            <td>

                <?php if ($discount): ?>

                    <small class="text-danger text-decoration-line-through">
                        <?= number_to_currency($hargaAsli, 'IDR') ?>
                    </small>

                    <br>

                <?php endif; ?>

                <?= number_to_currency($harga, 'IDR') ?>

            </td>

            <td>

                <input
                    type="number"
                    min="1"
                    class="form-control"
                    name="qty<?= $i++ ?>"
                    value="<?= $item['qty'] ?>">

            </td>

            <td>

                <?= number_to_currency($subtotal, 'IDR') ?>

            </td>

            <td>

                <a
                    href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>"
                    class="btn btn-danger">

                    <i class="bi bi-trash"></i>

                </a>

            </td>

        </tr>

    <?php
        endforeach;
    endif;
    ?>

    </tbody>

</table>

<div class="alert alert-info">

    Total = <?= number_to_currency($totalDiskon, 'IDR') ?>

</div>

<button type="submit" class="btn btn-primary">
    Perbarui Keranjang
</button>

<a class="btn btn-warning"
   href="<?= base_url('keranjang/clear') ?>">
    Kosongkan Keranjang
</a>

<?php if (!empty($items)): ?>

<a class="btn btn-success"
   href="<?= base_url('checkout') ?>">
    Selesai Belanja
</a>

<?php endif; ?>

<?= form_close() ?>

<?= $this->endSection() ?>