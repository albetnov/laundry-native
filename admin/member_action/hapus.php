<?php

require_once __DIR__ . '/../middleware.php';
require_once __DIR__ . '/../../helper.php';

if ($_SESSION['token'] !== $_GET['token']) {
    return redirect('/admin/member');
}
unset($_SESSION['token']);

$id = $_GET['id'];

if (!isset($id)) {
    $_SESSION['pesan'] = "Pelanggan tidak di temukan.";
    return redirect('/admin/member');
}

$find = connectDB()->prepare("SELECT * FROM tb_member WHERE id=?");
$find->execute([$id]);

if (!$find->fetch()) {
    $_SESSION['pesan'] = "Pelanggan tidak di temukan.";
    return redirect('/admin/member');
}

$delete = connectDB()->prepare('DELETE FROM tb_member WHERE id=?');
$delete->execute([$id]);

$_SESSION['pesan'] = "Data berhasil dihapus";
return redirect('/admin/member');
