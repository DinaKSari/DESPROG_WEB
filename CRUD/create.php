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

    if ($nim === '' || $nama === '' || $judul === '' || $tanggalPinjam === '') {
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
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Peminjaman</title>
</head>
<body>
    <h2>Tambah Data Peminjaman</h2>

    <?php if ($err): ?>
        <p style="color: red;"><?= htmlspecialchars($err) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>NIM:</label><br>
        <input type="text" name="nim" value="<?= htmlspecialchars($nim) ?>"><br><br>

        <label>Nama Mahasiswa:</label><br>
        <input type="text" name="nama_mahasiswa" value="<?= htmlspecialchars($nama) ?>"><br><br>

        <label>Judul Buku:</label><br>
        <input type="text" name="judul_buku" value="<?= htmlspecialchars($judul) ?>"><br><br>

        <label>Tanggal Pinjam:</label><br>
        <input type="date" name="tanggal_pinjam" value="<?= htmlspecialchars($tanggalPinjam) ?>"><br><br>

        <label>Tanggal Kembali (Opsional):</label><br>
        <input type="date" name="tanggal_kembali" value="<?= htmlspecialchars($tanggalKembali) ?>"><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="">-- Pilih Status --</option>
            <option value="dipinjam" <?= $status === 'dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
            <option value="dikembalikan" <?= $status === 'dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
            <option value="terlambat" <?= $status === 'terlambat' ? 'selected' : '' ?>>Terlambat</option>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>

    <p><a href="index.php">Kembali ke Daftar</a></p>
</body>
</html>