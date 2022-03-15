<?php

require_once __DIR__.'/../../../helper.php';

defined('CALLED') or exit;

function outlet()
{
    $call_data = connectDB()->query('SELECT * FROM tb_outlet');
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

function member()
{
    $call_data = connectDB()->query('SELECT * FROM tb_member');
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

function user()
{
    $call_data = connectDB()->query('SELECT * FROM tb_user');
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

function paket()
{
    $call_data = connectDB()->query('SELECT * FROM tb_paket');
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

// function transaksi()
// {
//     $call_data = connectDB()->query("SELECT * FROM tb_transaksi");
//     $call_data->execute();
//     $id_transaksi = connectDB()->lastInsertId();

//     return $id_transaksi->fetchAll(\PDO::FETCH_OBJ);
// }

function insert()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_outlet = escapeInput($_POST['id_outlet']);
        $kode_invoice = escapeInput($_POST['kode_invoice']);
        $id_member = escapeInput($_POST['id_member']);
        $tgl = escapeInput($_POST['tgl']);
        $batas_waktu = escapeInput($_POST['batas_waktu']);
        $tgl_bayar = escapeInput($_POST['tgl_bayar']);
        $biaya_tambahan = escapeInput($_POST['biaya_tambahan']);
        $diskon = escapeInput($_POST['diskon']);
        $pajak = escapeInput($_POST['pajak']);
        $status = escapeInput($_POST['status']);
        $dibayar = escapeInput($_POST['dibayar']);
        $id_user = escapeInput($_POST['id_user']);
        if (empty($id_outlet) || empty($kode_invoice) || empty($id_member) || empty($tgl) || empty($batas_waktu) || empty($tgl_bayar) || empty($status) || empty($dibayar) || empty($id_user)) {
            $_SESSION['pesan'] = 'Kolom tidak boleh ada yang kosong!';

            return redirect('/admin/transaksi_action/buat');
            exit;
        }

        $conn = connectDB();
        $conn->beginTransaction();

        try {
            $query = $conn->prepare('INSERT INTO tb_transaksi (id_outlet,kode_invoice,id_member,tgl,batas_waktu,tgl_bayar,biaya_tambahan,diskon,pajak,status,dibayar,id_user) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
            $attempt = $query->execute([$id_outlet, $kode_invoice, $id_member, $tgl, $batas_waktu, $tgl_bayar, $biaya_tambahan, $diskon, $pajak, $status, $dibayar, $id_user]);

            $id_transaksi = $conn->lastInsertId();
            $id_paket = escapeInput($_POST['id_paket']);
            $qty = escapeInput($_POST['qty']);
            $keterangan = escapeInput($_POST['keterangan']);

            $query2 = $conn->prepare('INSERT INTO tb_detail_transaksi (id_transaksi,id_paket,qty,keterangan) VALUES (?,?,?,?)');
            $attempt2 = $query2->execute([$id_transaksi, $id_paket, $qty, $keterangan]);
        } catch (\PDOException $e) {
            $conn->rollBack();
            $_SESSION['pesan'] = "Transaksi gagal: $e";

            return redirect('/admin/transaksi_action/buat');
        }
        $conn->commit();
        if ($attempt && $attempt2) {
            $_SESSION['pesan'] = 'Transaksi berhasil ditambah!';

            return redirect('/admin/transaksi');
            exit;
        }
    }
}
