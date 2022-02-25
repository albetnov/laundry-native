<?php

require_once __DIR__ . '/../../../helper.php';

defined('CALLED') or die;

function outlet()
{
    $call_data = connectDB()->query("SELECT * FROM tb_outlet");
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}

function edit()
{
    if (!isset($_GET['id'])) {
        $_SESSION['pesan'] = "Outlet tidak ditemukan";
        return redirect('/admin/outlet');
    }

    $id = $_GET['id'];

    $call_data = connectDB()->prepare("SELECT * FROM tb_outlet WHERE id=? LIMIT 1");
    $call_data->execute([$id]);

    $fetch = $call_data->fetchAll(\PDO::FETCH_OBJ);

    if (!$fetch) {
        $_SESSION['pesan'] = 'Outlet tidak ditemukan';
        return redirect('/admin/outlet');
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
        $tlp = escapeInput($_POST['tlp']);
        if (empty($nama) || empty($alamat) || empty($tlp)) {
            $_SESSION['pesan'] = "Kolom tidak boleh ada yang kosong!";
            echo "<script>location.href='" . base_url() . "/admin/outlet_action/edit?id={$id}'</script>";
            exit;
        }
    
        $query = connectDB()->prepare("UPDATE tb_outlet SET nama=?,alamat=?,tlp=? WHERE id=?");
        $attempt = $query->execute([$nama, $alamat, $tlp, $id]);

        if ($attempt) {
            $_SESSION['pesan'] = "Outlet berhasil diedit!";
            echo "<script>location.href='" . base_url() . "/admin/outlet'</script>";
            exit;
        }
    }
}
