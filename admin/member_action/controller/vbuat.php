<?php

require_once __DIR__.'/../../../helper.php';

defined('CALLED') or exit;

function insert()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = escapeInput($_POST['nama']);
        $alamat = escapeInput($_POST['alamat']);
        $jenis_kelamin = escapeInput($_POST['jenis_kelamin']);
        $tlp = escapeInput($_POST['tlp']);
        if (empty($nama) || empty($tlp) || empty($alamat) || empty($jenis_kelamin)) {
            $_SESSION['pesan'] = 'Kolom tidak boleh ada yang kosong!';

            return redirect('/admin/member_action/buat');
            exit;
        }

        $query = connectDB()->prepare('INSERT INTO tb_member (nama,alamat,jenis_kelamin,tlp) VALUES (?,?,?,?)');
        $attempt = $query->execute([$nama, $alamat, $jenis_kelamin, $tlp]);
        if ($attempt) {
            $_SESSION['pesan'] = 'Pelanggan berhasil ditambah!';

            return redirect('/admin/member');
            exit;
        }
    }
}
