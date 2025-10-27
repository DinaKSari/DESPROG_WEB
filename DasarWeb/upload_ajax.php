<?php
if (isset($_FILES['files'])) {
    $extensions = array("pdf", "doc", "docx", "txt");
    $maxSize = 2 * 1024 * 1024; // 2 MB
    $uploadDir = "documents/";

    // Pastikan direktori ada
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $totalFiles = count($_FILES['files']['name']);
    $response = "";

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $fileSize = $_FILES['files']['size'][$i];
        $fileTmp = $_FILES['files']['tmp_name'][$i];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validasi ekstensi
        if (!in_array($fileExt, $extensions)) {
            $response .= "File <b>$fileName</b> ditolak (hanya PDF, DOC, DOCX, TXT).<br>";
            continue;
        }

        // Validasi ukuran
        if ($fileSize > $maxSize) {
            $response .= "File <b>$fileName</b> terlalu besar (maksimal 2 MB).<br>";
            continue;
        }

        // Pindahkan file
        if (move_uploaded_file($fileTmp, $uploadDir . $fileName)) {
            $response .= "File <b>$fileName</b> berhasil diunggah.<br>";
        } else {
            $response .= "Gagal mengunggah file <b>$fileName</b>.<br>";
        }
    }

    echo $response;
} else {
    echo "Tidak ada file yang diunggah.";
}
?>
