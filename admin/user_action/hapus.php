<?php

require_once __DIR__ . '/../middleware.php';
require_once __DIR__ . '/../../helper.php';

if ($_SESSION['token'] !== $_GET['token']) {
    return redirect('/admin/user');
}
unset($_SESSION['token']);

$id = $_GET['id'];

if (!isset($id)) {
    $_SESSION['pesan'] = "User tidak di temukan.";
    return redirect('/admin/user');
}

$find = connectDB()->prepare("SELECT * FROM tb_user WHERE id=?");
$find->execute([$id]);

if (!$find->fetch()) {
    $_SESSION['pesan'] = "User tidak di temukan.";
    return redirect('/admin/user');
}

$delete = connectDB()->prepare('DELETE FROM tb_user WHERE id=?');
$delete->execute([$id]);

$_SESSION['pesan'] = "Data berhasil dihapus";
return redirect('/admin/user');
