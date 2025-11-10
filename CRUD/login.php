<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-lg-4 col-md-6 col-sm-8">
                
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">
                            <i class="bi bi-book-fill text-primary"></i>
                            Login Perpustakaan
                        </h2>
                        
                        <?php if (!empty($_GET['error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($_GET['error']) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($_GET['success'])): ?>
                            <div class="alert alert-success" role="alert">
                                <?= htmlspecialchars($_GET['success']) ?>
                            </div>
                        <?php endif; ?>

                        <form action="authenticate.php" method="post" autocomplete="off">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input id="username" name="username" type="text" class="form-control" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" name="password" type="password" class="form-control" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                            </div>
                        </form>
                        
                        <hr class="my-4">

                        <div class="text-center">
                            <a href="register.php">Belum punya akun? Register di sini</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>