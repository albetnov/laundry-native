<?php

require_once __DIR__ . '/../../../helper.php';

defined('CALLED') or die;

function insert()
{

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = escapeInput($_POST['nama']);
        $alamat = escapeInput($_POST['alamat']);
        $jenis_kelamin = escapeInput($_POST['jenis_kelamin']);
        $tlp = escapeInput($_POST['tlp']);
        if (empty($nama) || empty($tlp) || empty($alamat) || empty($jenis_kelamin)) {
            $_SESSION['pesan'] = "Kolom tidak boleh ada yang kosong!";
            echo "<script>location.href='" . base_url() . "/admin/member_action/buat'</script>";
            exit;
        }

        $query = connectDB()->prepare("INSERT INTO tb_member (nama,alamat,jenis_kelamin,tlp) VALUES (?,?,?,?)");
        $attempt = $query->execute([$nama, $alamat, $jenis_kelamin, $tlp]);
        if ($attempt) {
            $_SESSION['pesan'] = "Pelanggan berhasil ditambah!";
            echo "<script>location.href='" . base_url() . "/admin/member'</script>";
            exit;
        }
    }
}
