<?php

session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'owner') {
        if ($_SESSION['role'] == 'admin') {
            exit(header('location:../admin/dashboard'));
        } else {
            exit(header('location:../kasir/dashboard'));
        }
    }
} else {
    $_SESSION['pesan'] = 'Anda belum login!';
    exit(header('location:../index'));
}
