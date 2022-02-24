<?php
session_start();
require_once __DIR__ . '/helper.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = escapeInput($_POST['username']);
    $password = escapeInput($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['pesan'] = "Kolom tidak boleh ada yang kosong";
        exit(header('location:index'));
    }

    $stmt = connectDB()->prepare("SELECT * FROM tb_user WHERE username=?");
    $stmt->execute([$username]);
    $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

    if ($result) {
        foreach ($result as $row) {
            if (!password_verify($password, $row->password)) {
                $_SESSION['pesan'] = "Akun tidak ditemukan!";
                exit(header('location:index.php'));
            }
            $_SESSION['nama'] = $row->nama;
            $_SESSION['id'] = $row->id;
            $_SESSION['role'] = $row->role;
            var_dump($row->role);
            if ($row->role == 'admin') {
                exit(header('location:admin/dashboard'));
            } else if ($row->role == 'kasir') {
                exit(header('location:kasir/dashboard'));
            } else {
                exit(header('location:owner/dashboard'));
            }
        }
    } else {
        $_SESSION['pesan'] = "Akun tidak ditemukan!";
        exit(header('location:index.php'));
    }
} else {
    exit(header('location:index.php'));
}
