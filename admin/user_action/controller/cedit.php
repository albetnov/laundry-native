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
        $_SESSION['pesan'] = 'User tidak ditemukan';

        return redirect('/admin/user');
    }

    $id = $_GET['id'];

    $call_data = connectDB()->prepare('SELECT * FROM tb_user WHERE id=? LIMIT 1');
    $call_data->execute([$id]);

    $fetch = $call_data->fetchAll(\PDO::FETCH_OBJ);

    if (!$fetch) {
        $_SESSION['pesan'] = 'User tidak ditemukan';

        return redirect('/admin/user');
    }

    foreach ($fetch as $result);

    return $result;
}

function performEdit()
{
    $id = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = escapeInput($_POST['username']);
        $nama = escapeInput($_POST['nama']);
        $pass = escapeInput($_POST['pass']);
        $conpass = escapeInput($_POST['conpass']);
        $outlet = escapeInput($_POST['outlet']);
        $role = escapeInput($_POST['role']);
        if (empty($username) || empty($nama) || empty($outlet) || empty($role)) {
            $_SESSION['pesan'] = 'Kolom tidak boleh ada yang kosong!';

            return redirect('/admin/user_action/edit?id='.$id);
            exit;
        }
        if (trim($pass) !== '') {
            if (empty($conpass)) {
                $_SESSION['pesan'] = 'Kolom tidak boleh ada yang kosong!';

                return redirect('/admin/user_action/edit?id='.$id);
                exit;
            }
            if (strlen($pass) < 8 || strlen($conpass) < 8) {
                $_SESSION['pesan'] = 'Password anda terlalu pendek!';

                return redirect('/admin/user_action/edit?id='.$id);
                exit;
            }

            if ($pass != $conpass) {
                $_SESSION['pesan'] = 'Kolom password harus sama!';

                return redirect('/admin/user_action/edit?id='.$id);
                exit;
            }

            $pass = password_hash($pass, PASSWORD_BCRYPT);
            $query = connectDB()->prepare('UPDATE tb_user SET username=?,nama=?,password=?,id_outlet=?,role=? WHERE id=?');
            $attempt = $query->execute([$username, $nama, $pass, $outlet, $role, $id]);
        } else {
            $query = connectDB()->prepare('UPDATE tb_user SET username=?,nama=?,id_outlet=?,role=? WHERE id=?');
            $attempt = $query->execute([$username, $nama, $outlet, $role, $id]);
        }
        if ($attempt) {
            $_SESSION['pesan'] = 'User berhasil diedit!';

            return redirect('/admin/user');
            exit;
        }
    }
}
