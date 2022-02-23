<?php
require_once __DIR__ . '/middleware.php';
$title = "Manage Member";
define('CALLED', true);
require_once __DIR__ . '/controller/member.php';
require_once __DIR__ . '/header.php';
?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            Data Member
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tabel">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (get() as $row) : ?>
                            <tr>
                                <td><?= !isset($i) ? $i = 1 : ++$i ?></td>
                                <td><?= $row->nama ?></td>
                                <td><?= $row->alamat ?></td>
                                <td><?= $row->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
                                <td><?= $row->tlp ?></td>
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