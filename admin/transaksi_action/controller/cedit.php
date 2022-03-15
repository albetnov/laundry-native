<?php

require_once __DIR__ . '/../../../helper.php';

defined('CALLED') or die;

function outlet()
{
    $call_data = connectDB()->query("SELECT * FROM tb_outlet");
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

function member()
{
    $call_data = connectDB()->query("SELECT * FROM tb_member");
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

function user()
{
    $call_data = connectDB()->query("SELECT * FROM tb_user ");
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

function edit()
{
    if (!isset($_GET['id'])) {
        $_SESSION['pesan'] = "Paket tidak ditemukan";
        return redirect('/admin/transaksi');
    }

    $id = $_GET['id'];

    $sql = <<<'sql'
    SELECT kode_invoice, batas_waktu, status, tb_transaksi.id AS id_transaksi, tb_detail_transaksi.keterangan AS keterangan, tb_detail_transaksi.qty AS qty FROM tb_transaksi 
    INNER JOIN tb_detail_transaksi ON tb_transaksi.id = tb_detail_transaksi.id_transaksi WHERE tb_transaksi.id=?
    sql;

    $call_data = connectDB()->prepare($sql);
    $call_data->execute([$id]);

    $fetch = $call_data->fetchAll(\PDO::FETCH_OBJ);

    if (!$fetch) {
        $_SESSION['pesan'] = 'Paket tidak ditemukan';
        return redirect('/admin/transaksi');
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
            $_SESSION['pesan'] = "Kolom tidak boleh ada yang kosong!";
            return redirect("/admin/paket_action/edit?id=" . $id);
            exit;
        }

        $query = connectDB()->prepare("UPDATE tb_paket SET nama_paket=?, id_outlet=?, jenis=?, harga=? WHERE id=?");
        $attempt = $query->execute([$nama_paket, $id_outlet, $jenis, $harga, $id]);

        if ($attempt) {
            $_SESSION['pesan'] = "Paket berhasil diedit!";
            echo "<script>location.href='" . base_url() . "/admin/paket'</script>";
            exit;
        }
    }
}
