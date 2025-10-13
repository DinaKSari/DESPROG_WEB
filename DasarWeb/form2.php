<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uji Coba HTML Injection</title>
</head>
<body>

    <h2>Uji coba</h2>
    <p>Coba masukkan kode HTML seperti <strong>&lt;h1&gt;Ini Judul&lt;/h1&gt;</strong> atau <strong>&lt;script&gt;alert('Halo!')&lt;/script&gt;</strong></p>

    <form action="html_aman.php" method="POST">
        <input type="text" name="input" size="50"><br><br>
        <p>masukan email</p>
        <input type="email" name="email" id="">
        <button type="submit">Kirim</button>
    </form>

</body>
</html>