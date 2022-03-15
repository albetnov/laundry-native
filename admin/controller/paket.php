<?php

defined('CALLED') or exit;
require_once __DIR__.'/../../helper.php';

function get()
{
    $call_data = connectDB()->query('SELECT tb_paket.id, tb_paket.jenis AS jenis_paket, tb_paket.nama_paket, tb_paket.harga, tb_outlet.nama AS nama_outlet FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id');
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}
