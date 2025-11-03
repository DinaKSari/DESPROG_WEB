<?php
require __DIR__ . '/koneksi.php';

$err = $ok = '';
$nim = $nama = $judul = $tanggalPinjam = $tanggalKembali = $status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim     = trim($_POST['nim'] ?? '');
    $nama    = trim($_POST['nama_mahasiswa'] ?? '');
    $judul   = trim($_POST['judul_buku'] ?? '');
    $tanggalPinjam = trim($_POST['tanggal_pinjam'] ?? '');
    $tanggalKembali = trim($_POST['tanggal_kembali'] ?? '');
    $status = trim($_POST['status'] ?? '');

    if ($nim === '' || $nama === '' || $judul === '' ) {
        $err = 'NIM, Nama, judul buku dan tanggal peminjaman wajib diisi.';
    } else {
        try {
            $tanggalKembaliKosong = ($tanggalKembali === '') ? null : $tanggalKembali;
            qparams(
                'INSERT INTO public.peminjaman (nim, nama_mahasiswa, judul_buku, tanggal_pinjam, tanggal_kembali, status) VALUES ($1, $2, $3, $4, $5, $6)',
                [$nim, $nama, $judul, $tanggalPinjam, $tanggalKembaliKosong, $status]
            );
            header('Location: index.php');
            exit;
        } catch (Throwable $e) {
            $err = $e->getMessage();
        }
    }
}
?>