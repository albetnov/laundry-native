<?php
require_once __DIR__ . '/middleware.php';
$title = "Manage Transaksi";
define('CALLED', true);
require_once __DIR__ . '/controller/transaksi.php';
require_once __DIR__ . '/header.php';
?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            Data Transaksi
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tabel">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Outlet</th>
                            <th>Kode Invoice</th>
                            <th>Nama Member</th>
                            <th>Batas Waktu</th>
                            <th>Status</th>
                            <th>Pengurus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (get() as $row) : ?>
                            <tr>
                                <td><?= !isset($i) ? $i = 1 : ++$i ?></td>
                                <td><?= $row->nama_outlet ?></td>
                                <td><?= $row->kode_invoice ?></td>
                                <td><?= $row->nama_member ?></td>
                                <td><?= $row->batas_waktu ?></td>
                                <td><?= $row->status ?></td>
                                <td><?= $row->pengurus ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>
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

require_once __DIR__ . '/footer.php'; ?>