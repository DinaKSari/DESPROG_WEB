<?php
require __DIR__ . '/koneksi.php';

// Query gabungan
$res = q("select (*) from peminjaman");

$rows = pg_fetch_all($res) ?: [];
?>