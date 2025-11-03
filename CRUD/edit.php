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
$nama = $row['nama_mahasiswa'];
$judul = $row['judul_buku'];
$tanggalPinjam = $row['tanggal_pinjam'];
$tanggalKembali = $row['tanggal_kembali'];
$status = $row['status'];

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
                'UPDATE public.peminjaman
                   SET nim=$1, nama_mahasiswa=$2, judul_buku=$3, tanggal_pinjam=$4, tanggal_kembali=$5, status=$6 WHERE id=$7',
                [$nim, $nama, $judul, $tanggalPinjam, $tanggalKembaliKosong, $status, $id]
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-4">
        <h2>Edit Data Peminjaman</h2>

        <?php if ($err): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($err) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= htmlspecialchars($nim) ?>">
            </div>

            <div class="mb-3">
                <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa:</label>
                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="<?= htmlspecialchars($nama) ?>">
            </div>

            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku:</label>
                <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?= htmlspecialchars($judul) ?>">
            </div>

            <div class="mb-3">
                <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam:</label>
                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="<?= htmlspecialchars($tanggalPinjam) ?>">
            </div>

            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali (Opsional):</label>
                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="<?= htmlspecialchars($tanggalKembali) ?>">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" id="status" name="status">
                    <option value="">-- Pilih Status --</option>
                    <option value="dipinjam" <?= $status === 'dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                    <option value="dikembalikan" <?= $status === 'dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                    <option value="terlambat" <?= $status === 'terlambat' ? 'selected' : '' ?>>Terlambat</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <p class="mt-3"><a href="index.php">Kembali ke Daftar</a></p>
    </div>

    </body>
</html>