<?php

if (PHP_SAPI !== 'cli') {
    exit;
}

require_once __DIR__.'/helper.php';

$pass = password_hash('root123', PASSWORD_BCRYPT);

$query = connectDB()->query("INSERT INTO tb_user (nama,username,password,id_outlet,role) VALUES ('Superuser', 'root', '{$pass}', 1, 'admin')");
$query->execute();
