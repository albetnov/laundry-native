<?php

session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'admin') {
        if ($_SESSION['role'] == 'kasir') {
            header('location:../kasir/dashboard');
            exit;
        } else {
            header('location:../owner/dashboard');
            exit;
        }
    }
} else {
    $_SESSION['pesan'] = "Anda belum login!";
    header('location:../index');
    exit;
}
