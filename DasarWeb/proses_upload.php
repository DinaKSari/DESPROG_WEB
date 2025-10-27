<?php
// Lokasi penyimpanan file yang diunggah
$targetDirectory = "uploads/";

// Periksa apakah direktori penyimpanan ada, jika tidak maka buat
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

if (isset($_FILES['files']['name'][0])) {
    $totalFiles = count($_FILES['files']['name']);

    // Daftar ekstensi yang diizinkan
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $targetFile = $targetDirectory . basename($fileName);
        $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Periksa apakah ekstensi file sesuai
        if (in_array($fileExtension, $allowedExtensions)) {
            // Pindahkan file yang diunggah ke direktori penyimpanan
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
                echo "File <b>$fileName</b> berhasil diunggah.<br>";
            } else {
                echo "Gagal mengunggah file <b>$fileName</b>.<br>";
            }
        } else {
            echo "File <b>$fileName</b> tidak diizinkan. Hanya jpg, jpeg, png, dan gif yang diperbolehkan.<br>";
        }
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
?>
