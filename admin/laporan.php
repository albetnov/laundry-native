<?php
require_once __DIR__.'/middleware.php';
$title = 'Manage Outlet';
define('CALLED', true);
require_once __DIR__.'/controller/laporan.php';
require_once __DIR__.'/header.php';
?>

<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            Laporan
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['pesan'])) {
    ?>
                <div class="alert alert-primary"><?= $_SESSION['pesan'] ?></div>
            <?php
                unset($_SESSION['pesan']);
}
            ?>
            <div class="table-responsive">
                <table class="table" id="tabel">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (get() as $row) { ?>
                            <tr>
                                <td><?= !isset($i) ? $i = 1 : ++$i ?></td>
                                <td><?= $row->nama ?></td>
                                <td>
                                    <!-- <button class="btn btn-sm btn-primary" onclick="location.href='<?= base_url().'/admin/outlet_action/edit?id='.$row->id ?>'"><i class="fas fa-pen"></i></button> -->
                                    <!-- <button class="btn btn-sm btn-primary" onclick="location.href='<?= base_url().'/admin/laporan_action/detail?id'.$row->id?>"><i class="fas fa-align-justify"></i>&nbsp; Detail Data &nbsp;</button> -->
                                    <button class="btn btn-sm btn-primary" onclick="location.href='<?= base_url() ?>/admin/laporan_action/transaksi'"><i class="fas fa-align-justify"></i> Detail Data</button>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$js = <<<'js'
<script>
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>
js;
require_once __DIR__.'/footer.php' ?>