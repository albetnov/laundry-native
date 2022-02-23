<?php

defined('CALLED') or die;
require_once __DIR__ . '/../../helper.php';

function get()
{
    $call_data = connectDB()->query("SELECT * FROM tb_outlet");
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}
