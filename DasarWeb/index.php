<?php

// --- KONFIGURASI KONEKSI POSTGRESQL ---
$host = 'localhost';
$port = '5432';
$dbname = 'phpdatabase';
$user = 'postgres';
$pass = 'apayah34.';

// Membuat koneksi
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
if (!$conn) {
    die('Koneksi gagal: ' . pg_last_error());
}

// Set encoding (opsional tapi dianjurkan)
pg_set_client_encoding($conn, 'UTF8');

// Ambil data dari tabel mahasiswa
// Pakai alias agar array assoc tetap menggunakan key "Nama", "Nim", dst.
$sql = 'SELECT
            "Nim"       AS "Nim",
            "Nama"      AS "Nama",
            "Email"     AS "Email",
            "Jurusan"   AS "Jurusan"
        FROM "TB_Mahasiswa"
        ORDER BY "Nim"';

$result = pg_query($conn, $sql);
if (!$result) {
    die('Query gagal: ' . pg_last_error($conn));
}
?>