<?php

function escapeInput($input)
{
    return htmlspecialchars($input);
}

function vdd(...$dump)
{
    die(var_dump($dump));
}

function connectDB()
{
    try {
        $koneksi = new \PDO("mysql:dbname=laundry;host=127.0.0.1", "root", "");
    } catch (\PDOException $e) {
        print_r("Erorr: {$e}");
    }
    return $koneksi;
}
