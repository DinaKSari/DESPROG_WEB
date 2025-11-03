<?php
require __DIR__ . '/koneksi.php';

// Query gabungan
$res = q('select id, nama_mahasiswa, nim, judul_buku, tanggal_pinjam, tanggal_kembali, status from public.peminjaman order by id desc');

$rows = pg_fetch_all($res) ?: [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Data Peminjaman Buku</h2>
        <a href="create.php" class="btn btn-primary">+ Tambah Peminjaman</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Mahasiswa</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rows)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Tidak ada data peminjaman.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td><?= htmlspecialchars($r['id']) ?></td>
                                <td><?= htmlspecialchars($r['nama_mahasiswa']) ?></td>
                                <td><?= htmlspecialchars($r['nim']) ?></td>
                                <td><?= htmlspecialchars($r['judul_buku']) ?></td>
                                <td><?= htmlspecialchars($r['tanggal_pinjam']) ?></td>
                                <td><?= htmlspecialchars($r['tanggal_kembali'] ?? '') ?></td>
                                <td>
                                    <?php
                                        $status = htmlspecialchars($r['status']);
                                        $badgeClass = match($status) {
                                            'dipinjam'    => 'bg-warning text-dark',
                                            'dikembalikan'=> 'bg-success',
                                            'terlambat'   => 'bg-danger',
                                            default       => 'bg-secondary'
                                        };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="delete.php" method="POST" style="display: inline;" onsubmit="return confirm('Hapus data ini?')">
                                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>