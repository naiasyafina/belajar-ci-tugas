<?php foreach($discounts as $discount): ?>

<div class="modal fade"
id="editModal-<?= $discount['id'] ?>">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5>Edit Diskon</h5>

<button class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<?= form_open(base_url('discount/edit/'.$discount['id'])) ?>

<div class="modal-body">

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
value="<?= $discount['tanggal'] ?>"
readonly>

</div>

<div class="mb-3">

<label>Nominal</label>

<input
type="number"
name="nominal"
class="form-control"
value="<?= $discount['nominal'] ?>"
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

<?php endforeach ?>