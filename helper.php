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

function get_http_protocol()
{
    if (!empty($_SERVER['HTTPS'])) {
        return "https";
    } else {
        return "http";
    }
}

function base_url($portOnly = false)
{
    if ($portOnly) {
        return $_SERVER['SERVER_PORT'];
    }
    $port = isset($_SERVER['SERVER_PORT']) ? ':' . $_SERVER['SERVER_PORT'] : '';
    $server = explode('/', $_SERVER['REQUEST_URI']);
    return get_http_protocol() . '://' . $_SERVER['SERVER_NAME'] . $port . '/' . $server[1];
}

function redirect($url)
{
    echo "<script>location.href='" . base_url() . "{$url}'</script>";
    exit;
}
