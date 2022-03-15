<?php

defined('CALLED') or exit;
require_once __DIR__.'/../../helper.php';

function get()
{
    $sql = <<<'sql'
    SELECT tb_outlet.nama AS nama_outlet, kode_invoice, tb_member.nama AS nama_member, batas_waktu, status, tb_user.nama AS pengurus, tb_transaksi.id AS id_transaksi FROM tb_transaksi 
    INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id 
    INNER JOIN tb_member ON tb_transaksi.id_member = tb_member.id 
    INNER JOIN tb_user ON tb_transaksi.id_user = tb_user.id
    sql;
    $call_data = connectDB()->query($sql);
    $call_data->execute();

    return $call_data->fetchAll(\PDO::FETCH_OBJ);
}
