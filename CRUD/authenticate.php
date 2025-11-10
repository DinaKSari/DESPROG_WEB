<?php
session_start();
require_once 'koneksi.php';

// ambil input
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// ambil koneksi
try {
    $conn = get_pg_connection();
} catch (Throwable $e) {
    error_log('DB connection error in authenticate.php: ' . $e->getMessage());
    header('Location: login.php?error=' . urlencode('Gagal koneksi ke database.'));
    exit;
}

// validasi
if ($username === '' || $password === '') {
    header('Location: login.php?error=' . urlencode('Username dan password harus diisi.'));
    exit;
}

// gunakan prepared query untuk menghindari SQL injection
$sql = 'SELECT id, username, password_hash, full_name FROM public.users WHERE username = $1 LIMIT 1';
$result = pg_query_params($conn, $sql, array($username));

if (!$result) {
    header('Location: login.php?error=' . urlencode('Terjadi kesalahan pada server.'));
    exit;
}

if (pg_num_rows($result) === 0) {
    header('Location: login.php?error=' . urlencode('Username atau password salah.'));
    exit;
}

$user = pg_fetch_assoc($result);
$hash = $user['password_hash'];

// verifikasi password
if (password_verify($password, $hash)) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama_user'] = $user['full_name'];
    header('Location: index.php'); 
    exit;
} else {
    header('Location: login.php?error=' . urlencode('Username atau password salah.'));
    exit;
}