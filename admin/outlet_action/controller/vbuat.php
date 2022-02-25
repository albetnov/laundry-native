<?php

require_once __DIR__ . '/../../../helper.php';

defined('CALLED') or die;

function outlet()
{
    $call_data = connectDB()->query("SELECT * FROM tb_outlet");
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

function insert()
{

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = escapeInput($_POST['nama']);
        $tlp = escapeInput($_POST['tlp']);
        $alamat = escapeInput($_POST['alamat']);
        if (empty($nama) || empty($tlp) || empty($alamat)) {
            $_SESSION['pesan'] = "Kolom tidak boleh ada yang kosong!";
            echo "<script>location.href='" . base_url() . "/admin/outlet_action/buat'</script>";
            exit;
        }

        $query = connectDB()->prepare("INSERT INTO tb_outlet (nama,alamat,tlp) VALUES (?,?,?)");
        $attempt = $query->execute([$nama, $alamat, $tlp]);
        if ($attempt) {
            $_SESSION['pesan'] = "Outlet berhasil ditambah!";
            echo "<script>location.href='" . base_url() . "/admin/outlet'</script>";
            exit;
        }
    }
}
