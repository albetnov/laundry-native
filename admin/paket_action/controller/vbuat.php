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
        $nama_paket = escapeInput($_POST['nama_paket']);
        $id_outlet = escapeInput($_POST['id_outlet']);
        $jenis = escapeInput($_POST['jenis']);
        $harga = escapeInput($_POST['harga']);
        if (empty($nama_paket) || empty($id_outlet) || empty($jenis) || empty($harga)) {
            $_SESSION['pesan'] = "Kolom tidak boleh ada yang kosong!";
            echo "<script>location.href='" . base_url() . "/admin/paket_action/buat'</script>";
            exit;
        }

        $query = connectDB()->prepare("INSERT INTO tb_paket (nama_paket,id_outlet,jenis, harga) VALUES (?,?,?,?)");
        $attempt = $query->execute([$nama_paket, $id_outlet, $jenis, $harga]);
        if ($attempt) {
            $_SESSION['pesan'] = "Paket berhasil ditambah!";
            echo "<script>location.href='" . base_url() . "/admin/paket'</script>";
            exit;
        }
    }
}
