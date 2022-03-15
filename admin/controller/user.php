<?php

defined('CALLED') or exit;
require_once __DIR__.'/../../helper.php';

function get()
{
    $call_data = connectDB()->query('SELECT tb_user.id,tb_user.nama AS nama_user,tb_user.username AS username_user,tb_user.role,tb_user.id_outlet, tb_outlet.nama AS nama_outlet FROM tb_user INNER JOIN tb_outlet ON tb_user.id_outlet = tb_outlet.id');
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}
