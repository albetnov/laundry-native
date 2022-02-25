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
        $username = escapeInput($_POST['username']);
        $nama = escapeInput($_POST['nama']);
        $pass = escapeInput($_POST['pass']);
        $conpass = escapeInput($_POST['conpass']);
        $outlet = escapeInput($_POST['outlet']);
        $role = escapeInput($_POST['role']);
        if (empty($username) || empty($nama) || empty($pass) || empty($conpass) || empty($outlet) || empty($role)) {
            $_SESSION['pesan'] = "Kolom tidak boleh ada yang kosong!";
            return redirect('/admin/user_action/buat');
            exit;
        }

        if (strlen($pass) < 8 || strlen($conpass) < 8) {
            $_SESSION['pesan'] = "Password anda terlalu pendek!";
            return redirect('/admin/user_action/buat');
            exit;
        }

        if ($pass != $conpass) {
            $_SESSION['pesan'] = "Kolom password harus sama!";
            return redirect('/admin/user_action/buat');
            exit;
        }

        $pass = password_hash($pass, PASSWORD_BCRYPT);
        $query = connectDB()->prepare("INSERT INTO tb_user (username,nama,password,id_outlet,role) VALUES (?,?,?,?,?)");
        $attempt = $query->execute([$username, $nama, $pass, $outlet, $role]);
        if ($attempt) {
            $_SESSION['pesan'] = "User berhasil ditambah!";
            return redirect('/admin/user');
            exit;
        }
    }
}
