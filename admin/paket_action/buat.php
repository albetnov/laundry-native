<?php
require_once __DIR__ . '/../middleware.php';
$title = "Buat Paket";
define('CALLED', true);
require_once __DIR__ . '/controller/vbuat.php';
require_once __DIR__ . '/../header.php';
insert();
?>
<div class="container-fluid mb-2">
    <div class="card">
        <div class="card-header">
            Buat Data Paket
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
                        <input type="text" name="nama_paket" class="form-control" placeholder="Masukkan nama paket...">
                    </div>
                    <div class="col">
                        <select name="id_outlet" class="form-control" id="id_outlet">
                            <option value="" selected>---Pilih Outlet---</option>
                            <?php
                                foreach(outlet() as $row) :
                            ?>
                            <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <input type="text" name="jenis" class="form-control" placeholder="Jenis paket...">
                    </div>
                    <div class="col">
                        <input type="number" name="harga" class="form-control" placeholder="Harga paket...">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-paper-plane"></i></button> 
                <button type="button" class="btn btn-sm btn-secondary" onclick="location.href='<?= base_url() ?>/admin/paket'"><i class="fas fa-arrow-left"></i></button>
            </form>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/../footer.php'; ?>