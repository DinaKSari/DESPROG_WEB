<?php
require __DIR__ . '/koneksi.php';

// Query gabungan
$res = q('select id, nama_mahasiswa, nim, judul_buku, tanggal_pinjam, tanggal kembali, status from public.peminjaman order by id desc');

$rows = pg_fetch_all($res) ?: [];
?>