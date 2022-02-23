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

function urlMatch($url, $class)
{
    $server = explode('/', $_SERVER['REQUEST_URI']);
    array_shift($server);
    array_shift($server);
    $server = '/' . implode('/', $server);
    if ($url == $server) {
        return $class;
    } else {
        return '';
    }
}
