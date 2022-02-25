<?php

require_once __DIR__ . '/../middleware.php';
require_once __DIR__ . '/../../helper.php';

if ($_SESSION['token'] !== $_GET['token']) {
    return redirect('/admin/paket');
}
unset($_SESSION['token']);

$id = $_GET['id'];

if (!isset($id)) {
    $_SESSION['pesan'] = "Paket tidak di temukan.";
    return redirect('/admin/paket');
}

$find = connectDB()->prepare("SELECT * FROM tb_paket WHERE id=?");
$find->execute([$id]);

if (!$find->fetch()) {
    $_SESSION['pesan'] = "Paket tidak di temukan.";
    return redirect('/admin/paket');
}

$delete = connectDB()->prepare('DELETE FROM tb_paket WHERE id=?');
$delete->execute([$id]);

$_SESSION['pesan'] = "Data berhasil dihapus";
return redirect('/admin/paket');
