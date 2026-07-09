<?php foreach($transactions as $trx): ?>

<div class="modal fade" id="editModal<?= $trx['id'] ?>">

    <div class="modal-dialog">

        <div class="modal-content">

            <?= form_open(base_url('pembelian/update/'.$trx['id'])) ?>

            <div class="modal-header">

                <h5>Ubah Status Pesanan</h5>

                <button
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="mb-3">

                    <label>Status</label>

                    <select
                        name="status"
                        class="form-control">

                        <option
                            value="0"
                            <?= $trx['status']==0?'selected':'' ?>>
                            Belum Selesai
                        </option>

                        <option
                            value="1"
                            <?= $trx['status']==1?'selected':'' ?>>
                            Sudah Selesai
                        </option>

                    </select>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>

                <button
                    class="btn btn-primary">
                    Simpan
                </button>

            </div>

            <?= form_close() ?>

        </div>

    </div>

</div>

<?php endforeach; ?>