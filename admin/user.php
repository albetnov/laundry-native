<?php
require_once __DIR__ . '/middleware.php';
$title = "Manage User";
define('CALLED', true);
require_once __DIR__ . '/controller/user.php';
require_once __DIR__ . '/header.php';
?>

<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            Data User
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tabel">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Outlet</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (get() as $row) : ?>
                            <tr>
                                <td><?= !isset($i) ? $i = 1 : ++$i ?></td>
                                <td><?= $row->nama_user ?></td>
                                <td><?= $row->username_user ?></td>
                                <td><?= $row->role ?></td>
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
</div>
<?php
$js = <<<'js'
<script>
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>
js;
require_once __DIR__ . '/footer.php' ?>