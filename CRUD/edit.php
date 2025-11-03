<?php
require __DIR__ . '/koneksi.php';

$err = '';
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    exit('ID tidak valid.');
}

// Ambil data lama
try {
    $res = qparams('select id, nama_mahasiswa, nim, judul_buku, tanggal_pinjam, tanggal_kembali, status from public.peminjaman WHERE id=$1', [$id]);
    $row = pg_fetch_assoc($res);
    if (!$row) {
        http_response_code(404);
        exit('Data tidak ditemukan.');
    }
} catch (Throwable $e) {
    exit('Error: ' . htmlspecialchars($e->getMessage()));
}

$nim = $row['nim'];
$nama = $row['nama'];
$judul = $row['judul_buku'];
$tanggalPinjam = $row['tanggal_pinjam'];
$tanggalKembali = $row['tanggal_kembali'];
$status = $row['status'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim     = trim($_POST['nim'] ?? '');
    $nama    = trim($_POST['nama'] ?? '');
    $judul   = trim($_POST['judul_buku'] ?? '');
    $tanggalPinjam = trim($_POST['tanggal_pinjam'] ?? '');
    $tanggalKembali = trim($_POST['tanggal_kembali'] ?? '');
    $status = trim($_POST['status'] ?? '');

    if ($nim === '' || $nama === '' || $judul === '' || $tanggalPinjam === '') {
        $err = 'NIM, Nama, judul buku dan tanggal peminjaman wajib diisi.';
    } else {
        try {
            qparams(
                'UPDATE public.peminjaman
                   SET nim=$1, nama_mahasiswa=$2, judul_buku=$3, tanggal_pinjam=$, jurusan=NULLIF($4, \'\')
                 WHERE id=$5',
                [$nim, $nama, $email, $jurusan, $id]
            );
            header('Location: index.php');
            exit;
        } catch (Throwable $e) {
            $err = $e->getMessage();
        }
    }
}
?>