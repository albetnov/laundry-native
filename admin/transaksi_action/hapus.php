<?php

require_once __DIR__.'/../middleware.php';
require_once __DIR__.'/../../helper.php';

if ($_SESSION['token'] !== $_GET['token']) {
    return redirect('/admin/transaksi');
}
unset($_SESSION['token']);

$id = $_GET['id'];

if (!isset($id)) {
    $_SESSION['pesan'] = 'transaksi tidak di temukan.';

    return redirect('/admin/transaksi');
}

$find = connectDB()->prepare('SELECT * FROM tb_transaksi WHERE id=?');
$find->execute([$id]);

if (!$find->fetch()) {
    $_SESSION['pesan'] = 'transaksi tidak di temukan.';

    return redirect('/admin/transaksi');
}

$delete = connectDB()->prepare('DELETE FROM tb_transaksi WHERE id=?');
$delete->execute([$id]);

$_SESSION['pesan'] = 'Data berhasil dihapus';

return redirect('/admin/transaksi');
