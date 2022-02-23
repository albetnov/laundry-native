<?php
require_once __DIR__ . '/middleware.php';
$title = "Manage Paket";
define('CALLED', true);
require_once __DIR__ . '/controller/paket.php';
require_once __DIR__ . '/header.php';
?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            Data User
        </div>
        <div class="card-body">
            <table class="table" id="tabel">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Paket</th>
                        <th>Nama Paket</th>
                        <th>Harga Paket</th>
                        <th>Outlet</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (get() as $row) : ?>
                        <tr>
                            <td><?= !isset($i) ? $i = 1 : ++$i ?></td>
                            <td><?= $row->jenis_paket ?></td>
                            <td><?= $row->nama_paket ?></td>
                            <td><?= $row->harga ?></td>
                            <td><?= $row->nama_outlet ?></td>
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

<?php
$js = <<<'js'
<script>
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>
js;

require_once __DIR__ . '/footer.php'; ?>