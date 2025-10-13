<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Proses</title>
</head>
<body>

    <h2>Hasil Input:</h2>

    <?php
    $input = $_POST['input'];
    $input_aman = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    echo $input_aman;

    // Memeriksa apakah input adalah email yang valid
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Lanjutkan dengan pengolahan email yang aman
    } else {
        // Tangani input yang tidak valid
    }
    ?>

    <hr>
    <h3>Penjelasan:</h3>
    <p>Jika Anda melihat teks <code>&lt;h1&gt;...&lt;/h1&gt;</code> secara harfiah dan bukan sebagai judul besar, itu artinya fungsi <code>htmlspecialchars</code> <strong>berhasil</strong> mengamankan input Anda.</p>
    <p>Lihat "View Page Source" di browser Anda untuk melihat bagaimana kode HTML asli diubah.</p>
    
    <br>
    <a href="form2.php">Kembali ke Form</a>

</body>
</html>