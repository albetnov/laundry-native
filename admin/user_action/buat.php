<?php
require_once __DIR__.'/../middleware.php';
$title = 'Buat User';
define('CALLED', true);
require_once __DIR__.'/controller/vbuat.php';
require_once __DIR__.'/../header.php';

insert();
?>
<div class="container-fluid mb-2">
    <div class="card">
        <div class="card-header">
            Buat Data User
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
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username anda...">
                    </div>
                    <div class="col">
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama anda...">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <input type="password" name="pass" class="form-control" placeholder="Masukkan password anda...">
                    </div>
                    <div class="col">
                        <input type="password" name="conpass" class="form-control" placeholder="Ketik ulang password anda...">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <select name="outlet" class="form-control">
                            <option value="">--PILIH OUTLET--</option>
                            <?php foreach (outlet() as $outlet) { ?>
                                <option value="<?= $outlet->id ?>"><?= $outlet->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="role" class="form-control">
                            <option value="">--PILIH ROLE--</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-paper-plane"></i></button>
                <button type="button" class="btn btn-sm btn-secondary" onclick="location.href='<?= base_url() ?>/admin/user'"><i class="fas fa-arrow-left"></i></button>
            </form>
        </div>
    </div>
</div>
<?php
require_once __DIR__.'/../footer.php'; ?>