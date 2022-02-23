<?php

session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'owner') {
        if ($_SESSION['role'] == 'admin') {
            header('location:../admin/dashboard');
            exit;
        } else {
            header('location:../kasir/dashboard');
            exit;
        }
    }
} else {
    $_SESSION['pesan'] = "Anda belum login!";
    header('location:../index');
    exit;
}
