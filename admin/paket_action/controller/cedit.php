<?php

require_once __DIR__.'/../../../helper.php';

defined('CALLED') or exit;

function outlet()
{
    $call_data = connectDB()->query('SELECT * FROM tb_outlet');
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

function edit()
{
    if (!isset($_GET['id'])) {
        $_SESSION['pesan'] = 'Paket tidak ditemukan';

        return redirect('/admin/paket');
    }

    $id = $_GET['id'];

    $call_data = connectDB()->prepare('SELECT * FROM tb_paket WHERE id=? LIMIT 1');
    $call_data->execute([$id]);

    $fetch = $call_data->fetchAll(\PDO::FETCH_OBJ);

    if (!$fetch) {
        $_SESSION['pesan'] = 'Paket tidak ditemukan';

        return redirect('/admin/paket');
    }

    foreach ($fetch as $result);

    return $result;
}

function performEdit()
{
    $id = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_paket = escapeInput($_POST['nama_paket']);
        $id_outlet = escapeInput($_POST['id_outlet']);
        $jenis = escapeInput($_POST['jenis']);
        $harga = escapeInput($_POST['harga']);
        if (empty($nama_paket) || empty($id_outlet) || empty($jenis) || empty($harga)) {
            $_SESSION['pesan'] = 'Kolom tidak boleh ada yang kosong!';

            return redirect('/admin/paket_action/edit?id='.$id);
            exit;
        }

        $query = connectDB()->prepare('UPDATE tb_paket SET nama_paket=?, id_outlet=?, jenis=?, harga=? WHERE id=?');
        $attempt = $query->execute([$nama_paket, $id_outlet, $jenis, $harga, $id]);

        if ($attempt) {
            $_SESSION['pesan'] = 'Paket berhasil diedit!';
            echo "<script>location.href='".base_url()."/admin/paket'</script>";
            exit;
        }
    }
}
