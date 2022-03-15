<?php
require_once __DIR__ . '/../middleware.php';
$title = "Buat Transaksi";
define('CALLED', true);
require_once __DIR__ . '/controller/vbuat.php';
require_once __DIR__ . '/../header.php';

insert();
?>
<div class="container-fluid mb-2">
    <div class="card">
        <div class="card-header">
            Buat Data Transaksi
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['pesan'])) {
            ?>
                <div class="alert alert-danger">Error: <?= $_SESSION['pesan'] ?></div>
            <?php
                unset($_SESSION['pesan']);
            }
            ?>
            <form action="#" method="POST">
                <div class="form-group row">
                    <div class="col">
                        <select name="id_outlet" class="form-control">
                            <option value="">--PILIH OUTLET--</option>
                            <?php foreach (outlet() as $outlet) : ?>
                                <option value="<?= $outlet->id ?>"><?= $outlet->nama ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="id_member" class="form-control">
                            <option value="">--PILIH MEMBER--</option>
                            <?php foreach (member() as $member) : ?>
                            <option value="<?= $member->id?>"><?= $member->nama?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        
                    <label>Kode Invoice</label>
                        <button class="btn" type="button" onclick="makeNew()">
                            <span class="badge bg-primary" style="color:white;"><i class="fas fa-undo"></i> Buat baru</span>
                        </button>
                        <input type="text" readonly name="kode_invoice" id="kode_invoice" class="form-control" placeholder="Klik tombol di atas...">
                    </div>
                    <div class="col">
                    <label>Tanggal Sekarang</label>
                        <input type="text" name="tgl" value="<?= date("Y/m/d")?>" readonly class="form-control" placeholder="Masukkan tanggal sekarang...">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                    <label>Batas Waktu Pembayaran</label>
                        <input type="date" name="batas_waktu" class="form-control" placeholder="Masukkan batas waktu pembayaran...">
                    </div>
                    <div class="col">
                        <label>Tanggal Bayar</label>
                        <input type="date" name="tgl_bayar" class="form-control" placeholder="Masukkan tanggal pembayaran...">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                    <!-- <label>&nbsp;</label> -->
                        <input type="number"  name="biaya_tambahan" class="form-control" placeholder="Masukkan biaya tambahan...">
                    </div>
                    <div class="col">
                        <input type="number"  name="diskon" class="form-control" placeholder="Masukkan diskon...">
                    </div>
                </div>
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle"></i> Biarkan kosong bila Biaya Tambahan/Diskon/Pajak tidak ada.
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>&nbsp;</label>
                        <input type="number"  name="pajak" class="form-control" placeholder="Masukkan pajak...">
                    </div>
                    <div class="col">
                        <label>Kuantitas</label>
                        <input type="number"  name="qty" min="1" value="1" class="form-control" placeholder="Masukkan Kuantitas...">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <select name="status" class="form-control">
                            <option value="">--PROSES PENGERJAAN--</option>
                            <option value="baru">Baru</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                            <option value="diambil">Diambil</option>
                        </select>
                    </div>
                    <div class="col">
                        <select name="dibayar" class="form-control">
                            <option value="">--STATUS PEMBAYARAN--</option>
                            <option value="dibayar">Sudah Dibayar</option>
                            <option value="belum_dibayar">Belum Dibayar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <select name="id_user" class="form-control">
                            <option value="">--PILIH USER--</option>
                            <?php foreach (user() as $user) : ?>
                            <option value="<?= $user->id?>"><?= $user->username?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="id_paket" class="form-control">
                            <option value="">--PILIH PAKET--</option>
                            <?php foreach (paket() as $paket) : ?>
                                <option value="<?= $paket->id?>"><?= $paket->nama_paket?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <textarea name="keterangan" class="form-control" placeholder="Masukkan Keterangan..."  rows="5"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-paper-plane"></i></button>
                <button type="button" class="btn btn-sm btn-secondary" onclick="location.href='<?= base_url() ?>/admin/transaksi'"><i class="fas fa-arrow-left"></i></button>
            </form>
        </div>
    </div>
</div>
<?php
$js = <<<'js'
<script>
function randomize(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return result;
}
function makeNew() {
    var kode = document.querySelector("#kode_invoice");
    kode.value = randomize(20);
}
</script>
js;
require_once __DIR__ . '/../footer.php'; ?>