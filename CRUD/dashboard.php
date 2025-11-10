<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require __DIR__ . '/koneksi.php';
$search = $_GET['search'] ?? ''; 

$sql = 'select id, nama_mahasiswa, nim, judul_buku, tanggal_pinjam, tanggal_kembali, status from public.peminjaman';
$params = []; 

if (!empty($search)) {
    $sql .= " WHERE nama_mahasiswa ILIKE $1 OR nim ILIKE $1 OR judul_buku ILIKE $1";
    $params[] = '%' . $search . '%'; 
}

$sql .= ' order by id desc';

if (!empty($params)) {
    $res = qparams($sql, $params);
} else {
    $res = q($sql);
}

$rows = pg_fetch_all($res) ?: [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Perpustakaan Digital</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="bi bi-house-door-fill"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">
            <i class="bi bi-book-fill"></i> Data Peminjaman
          </a>
        </li>
      </ul>
      
      <form class="d-flex" role="search" action="dashboard.php" method="GET">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari peminjam/buku..." aria-label="Search" value="<?= htmlspecialchars($search) ?>">
        <button class="btn btn-outline-success" type="submit">Cari</button>
      </form>

      <?php if (isset($_SESSION['user_id'])): ?>
        <div class="ms-2">
            <a href="logout.php" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Log Out
            </a>
        </div>
      <?php endif; ?>
      </div>
  </div>
</nav>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Data Peminjaman Buku</h2>
        <a href="create.php" class="btn btn-primary">+ Tambah Peminjaman</a>
    </div>

    <?php if (!empty($search)): ?>
        <div class="alert alert-info">
            Menampilkan hasil untuk pencarian: <strong>"<?= htmlspecialchars($search) ?>"</strong>. 
            <a href="dashboard.php" class="alert-link">Hapus filter</a>.
        </div>
    <?php endif; ?>

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
                            <td colspan="8" class="text-center py-4 text-muted">
                                <?php if (!empty($search)): ?>
                                    Data tidak ditemukan untuk pencarian "<?= htmlspecialchars($search) ?>".
                                <?php else: ?>
                                    Tidak ada data peminjaman.
                                <?php endif; ?>
                            </td>
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
                                            'dipinjam'     => 'bg-warning text-dark',
                                            'dikembalikan' => 'bg-success',
                                            'terlambat'    => 'bg-danger',
                                            default        => 'bg-secondary'
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