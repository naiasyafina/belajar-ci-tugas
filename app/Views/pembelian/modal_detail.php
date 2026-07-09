<?php foreach ($transactions as $trx) : ?>

<div class="modal fade" id="detailModal<?= $trx['id'] ?>" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Detail Transaksi #<?= $trx['id'] ?>
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <?php if (!empty($products[$trx['id']])) : ?>

                    <?php foreach ($products[$trx['id']] as $i => $item) : ?>

                        <b><?= $i + 1 ?>)</b><br>

                        <?php
                        if (
                            $item['foto'] != '' &&
                            file_exists("img/" . $item['foto'])
                        ) :
                        ?>

                            <img
                                src="<?= base_url('img/' . $item['foto']) ?>"
                                width="90"
                                class="mb-2">

                        <?php endif; ?>

                        <br>

                        <strong><?= $item['nama'] ?></strong>

                        <br>

                        Harga :
                        <?= number_to_currency($item['harga'], 'IDR') ?>

                        <br>

                        Jumlah :
                        <?= $item['jumlah'] ?> pcs

                        <br>

                        Diskon :
                        <?= number_to_currency($item['diskon'], 'IDR') ?>

                        <br>

                        Subtotal :
                        <?= number_to_currency($item['subtotal_harga'], 'IDR') ?>

                        <hr>

                    <?php endforeach; ?>

                <?php endif; ?>

                <strong>
                    Ongkir :
                    <?= number_to_currency($trx['ongkir'], 'IDR') ?>
                </strong>

            </div>

        </div>

    </div>

</div>

<?php endforeach; ?>