<?php
require __DIR__ . '/koneksi.php';

$res_total = q("SELECT COUNT(*) as total FROM public.peminjaman");
$total_peminjaman = pg_fetch_assoc($res_total)['total'] ?? 0;

$res_dipinjam = qparams("SELECT COUNT(*) as total FROM public.peminjaman WHERE status = $1", ['dipinjam']);
$total_dipinjam = pg_fetch_assoc($res_dipinjam)['total'] ?? 0;

$res_mahasiswa = q("SELECT COUNT(DISTINCT nim) as total FROM public.peminjaman");
$total_mahasiswa = pg_fetch_assoc($res_mahasiswa)['total'] ?? 0;

$search = '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perpustakaan</title>
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
          <a class="nav-link active" aria-current="page" href="index.php">
            <i class="bi bi-house-door-fill"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <i class="bi bi-book-fill"></i> Data Peminjaman
          </a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="dashboard.php" method="GET">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari peminjam/buku..." aria-label="Search" value="<?= htmlspecialchars($search) ?>">
        <button class="btn btn-outline-success" type="submit">Cari</button>
      </form>
    </div>
  </div>
</nav>
<div class="container py-4">
    <h2 class="mb-4">Dashboard Ringkasan</h2>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-muted">Total Transaksi</h5>
                            <h2 class="display-6 fw-bold"><?= $total_peminjaman ?></h2>
                        </div>
                        <i class="bi bi-journal-text" style="font-size: 3rem; color: #0d6efd;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-muted">Buku Dipinjam</h5>
                            <h2 class="display-6 fw-bold"><?= $total_dipinjam ?></h2>
                        </div>
                        <i class="bi bi-book" style="font-size: 3rem; color: #ffc107;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-muted">Total Anggota</h5>
                            <h2 class="display-6 fw-bold"><?= $total_mahasiswa ?></h2>
                        </div>
                        <i class="bi bi-people-fill" style="font-size: 3rem; color: #198754;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>