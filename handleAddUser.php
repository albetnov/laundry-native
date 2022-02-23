<?php
session_start();
require_once __DIR__ . '/helper.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = escapeInput($_POST['nama']);
    $username = escapeInput($_POST['username']);
    $pass = escapeInput($_POST['pass']);
    $conpass = escapeInput($_POST['conpass']);

    if (empty($nama) || empty($username) || empty($pass) || empty($conpass)) {
    }
} else {
    header('location:index.php');
    exit;
}
