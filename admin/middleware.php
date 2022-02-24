<?php

session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'admin') {
        if ($_SESSION['role'] == 'kasir') {
            exit(header('location:../kasir/dashboard'));
        } else {
            exit(header('location:../owner/dashboard'));
        }
    }
} else {
    $_SESSION['pesan'] = "Anda belum login!";
    exit(header('location:../index'));
}
