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
            <div class="d-flex justify-content-end align-end align-items-end mb-2">
                <button class="btn btn-sm btn-primary" onclick="location.href='<?= base_url() ?>/admin/member_action/buat'"><i class="fas fa-plus-circle"></i> Tambah Data</button>
            </div>
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
                                <button class="btn btn-sm btn-primary" onclick="location.href='<?= base_url() . '/admin/member_action/edit?id=' . $row->id ?>'"><i class="fas fa-pen"></i></button>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?= $row->id ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="hapusData<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus data?</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Yakin hapus data, <?= $row->nama ?>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tidak</button>
                                                    <?php
                                                    if (!isset($_SESSION['token'])) {
                                                        $_SESSION['token'] = bin2hex(random_bytes(32));
                                                    }
                                                    ?>
                                                    <button type="button" class="btn btn-primary" onclick="location.href='<?= base_url() . '/admin/member_action/hapus?id=' . $row->id . '&token=' . $_SESSION['token'] ?>'"><i class="fas fa-check"></i> Ya, hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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