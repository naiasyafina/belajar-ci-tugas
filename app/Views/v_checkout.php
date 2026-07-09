<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row">

    <!-- FORM CHECKOUT -->
    <div class="col-lg-6">

        <?= form_open('buy','class="row g-3"') ?>

        <?= form_hidden('username', session()->get('username')) ?>
       <?= form_input([
    'type' => 'hidden',
    'name' => 'total_harga',
    'id'   => 'total_harga',
    'value'=> ''
]) ?>

        <div class="col-12">
            <label class="form-label">Nama</label>

            <input
                type="text"
                class="form-control"
                value="<?= session()->get('username') ?>"
                readonly>
        </div>

        <div class="col-12">
            <label class="form-label">Alamat</label>

            <input
                type="text"
                class="form-control"
                name="alamat"
                id="alamat">
        </div>

        <div class="col-12">
            <label class="form-label">Kelurahan</label>

            <select
                name="kelurahan"
                id="kelurahan"
                class="form-control">
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Layanan</label>

            <select
                name="layanan"
                id="layanan"
                class="form-control">
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Ongkir</label>

            <input
                type="text"
                class="form-control"
                id="ongkir"
                name="ongkir"
                readonly>
        </div>

        <div class="col-12">
            <button class="btn btn-primary">
                Buat Pesanan
            </button>
        </div>

        <?= form_close() ?>

    </div>

    <!-- DETAIL BELANJA -->
    <div class="col-lg-6">

        <?php if($discount): ?>

            <div class="alert alert-success">

                Diskon Hari Ini :
                <strong>
                    <?= number_to_currency($discount['nominal'],'IDR') ?>
                </strong>
                per produk

            </div>

        <?php endif; ?>

        <table class="table">

            <thead>

            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>SubTotal</th>
            </tr>

            </thead>

            <tbody>

            <?php

            $subtotal = 0;

            foreach($items as $item):

                $hargaAsli = $item['price'];

                if($discount){
                    $harga = max(0,$hargaAsli-$discount['nominal']);
                }else{
                    $harga = $hargaAsli;
                }

                $sub = $harga*$item['qty'];

                $subtotal += $sub;

            ?>

            <tr>

                <td><?= $item['name'] ?></td>

                <td>

                    <?php if($discount): ?>

                        <small class="text-danger text-decoration-line-through">

                            <?= number_to_currency($hargaAsli,'IDR') ?>

                        </small>

                        <br>

                    <?php endif; ?>

                    <?= number_to_currency($harga,'IDR') ?>

                </td>

                <td><?= $item['qty'] ?></td>

                <td><?= number_to_currency($sub,'IDR') ?></td>

            </tr>

            <?php endforeach; ?>

            <tr>

                <td colspan="2"></td>

                <td>Subtotal</td>

                <td>

                    <?= number_to_currency($subtotal,'IDR') ?>

                </td>

            </tr>

            <tr>

                <td colspan="2"></td>

                <td>Total</td>

                <td>

                    <span id="total">
                        <?= number_to_currency($subtotal,'IDR') ?>
                    </span>

                </td>

            </tr>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>

<script>

$(document).ready(function(){

    let subtotal = <?= $discount ? ($total - ($discount['nominal'] * count($items))) : $total ?>;

    let ongkir = 0;

    hitungTotal();

    function hitungTotal(){

        let total = subtotal + ongkir;

        $("#ongkir").val(ongkir);

        $("#total").text("IDR "+total.toLocaleString('id-ID'));

        $("#total_harga").val(total);

    }

    $('#kelurahan').select2({

        placeholder:'Cari daerah tujuan',

        minimumInputLength:3,

        ajax:{

            url:'<?= site_url('ajax/destinations')?>',

            dataType:'json',

            delay:300,

            data:function(params){

                return{

                    q:params.term

                }

            },

            processResults:function(data){

                return data;

            }

        }

    });

    $("#kelurahan").change(function(){

        let tujuan=$(this).val();

        $("#layanan").empty();

        ongkir=0;

        hitungTotal();

        $.ajax({

            url:'<?= site_url('ajax/costs')?>',

            dataType:'json',

            data:{

                destination:tujuan

            },

            success:function(data){

                data.forEach(function(item){

                    $("#layanan").append(

                        $("<option>",{

                            value:item.cost,

                            text:item.description+" ("+item.service+") : estimasi "+item.etd

                        })

                    );

                });

            }

        });

    });

    $("#layanan").change(function(){

        ongkir=parseInt($(this).val());

        hitungTotal();

    });

});

</script>

<?= $this->endSection() ?>