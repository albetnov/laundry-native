<?php
require_once __DIR__.'/../middleware.php';
$title = 'Edit User';
define('CALLED', true);
require_once __DIR__.'/controller/cedit.php';
require_once __DIR__.'/../header.php';
$data = edit();
performEdit();
?>
<div class="container-fluid mb-2">
    <div class="card">
        <div class="card-header">
            Edit Data Outlet
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
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama outlet..." value="<?= $data->nama ?>">
                    </div>
                    <div class="col">
                        <input type="text" name="tlp" class="form-control" placeholder="0812xxxxxxxx" value="<?= $data->tlp ?>">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat outlet..." value="<?= $data->alamat ?>">
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-paper-plane"></i></button>
                <button type="button" class="btn btn-sm btn-secondary" onclick="location.href='<?= base_url() ?>/admin/user'"><i class="fas fa-arrow-left"></i></button>
            </form>
        </div>
    </div>
</div>
<?php
require_once __DIR__.'/../footer.php'; ?>