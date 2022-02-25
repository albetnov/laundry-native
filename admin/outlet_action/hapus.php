<?php

require_once __DIR__ . '/../middleware.php';
require_once __DIR__ . '/../../helper.php';

if ($_SESSION['token'] !== $_GET['token']) {
    return redirect('/admin/outlet');
}
unset($_SESSION['token']);

$id = $_GET['id'];

if (!isset($id)) {
    $_SESSION['pesan'] = "Outlet tidak di temukan.";
    return redirect('/admin/outlet');
}

$find = connectDB()->prepare("SELECT * FROM tb_outlet WHERE id=?");
$find->execute([$id]);

if (!$find->fetch()) {
    $_SESSION['pesan'] = "Outlet tidak di temukan.";
    return redirect('/admin/outlet');
}

$delete = connectDB()->prepare('DELETE FROM tb_outlet WHERE id=?');
$delete->execute([$id]);

$_SESSION['pesan'] = "Data berhasil dihapus";
return redirect('/admin/outlet');
