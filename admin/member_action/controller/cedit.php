<?php

require_once __DIR__ . '/../../../helper.php';

defined('CALLED') or die;

function edit()
{
    if (!isset($_GET['id'])) {
        $_SESSION['pesan'] = "Pelanggan tidak ditemukan";
        return redirect('/admin/member');
    }

    $id = $_GET['id'];

    $call_data = connectDB()->prepare("SELECT * FROM tb_member WHERE id=? LIMIT 1");
    $call_data->execute([$id]);

    $fetch = $call_data->fetchAll(\PDO::FETCH_OBJ);

    if (!$fetch) {
        $_SESSION['pesan'] = 'Pelanggan tidak ditemukan';
        return redirect('/admin/member');
    }

    foreach ($fetch as $result);

    return $result;
}

function performEdit()
{
    $id = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = escapeInput($_POST['nama']);
        $alamat = escapeInput($_POST['alamat']);
        $jenis_kelamin = escapeInput($_POST['jenis_kelamin']);
        $tlp = escapeInput($_POST['tlp']);
        if (empty($nama) || empty($tlp) || empty($alamat) || empty($jenis_kelamin)) {
            $_SESSION['pesan'] = "Kolom tidak boleh ada yang kosong!";
            return redirect("/admin/member_action/edit?id=" . $id);
            exit;
        }

        $query = connectDB()->prepare("UPDATE tb_member SET nama=?, jenis_kelamin=?, alamat=?,tlp=? WHERE id=?");
        $attempt = $query->execute([$nama, $jenis_kelamin, $alamat, $tlp, $id]);

        if ($attempt) {
            $_SESSION['pesan'] = "Pelanggan berhasil diedit!";
            return redirect("admin/member");
            exit;
        }
    }
}
