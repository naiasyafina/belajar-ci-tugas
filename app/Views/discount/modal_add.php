<div class="modal fade" id="addModal">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5>Tambah Diskon</h5>

<button class="btn-close" data-bs-dismiss="modal"></button>

</div>

<?= form_open(base_url('discount')) ?>

<div class="modal-body">

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Nominal</label>

<input
type="number"
name="nominal"
class="form-control"
required>

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