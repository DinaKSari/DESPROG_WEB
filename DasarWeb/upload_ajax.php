<?php
if (isset($_FILES['file'])) {
    
    $responses = array();
    // 1. Ubah ekstensi yang diizinkan
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    $upload_path = "uploads/"; // Ganti nama folder jika perlu

    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0755, true);
    }

    $total_files = count($_FILES['file']['name']);

    for ($i = 0; $i < $total_files; $i++) {
        
        $file_name = $_FILES['file']['name'][$i];
        $file_size = $_FILES['file']['size'][$i];
        $file_tmp = $_FILES['file']['tmp_name'][$i];
        $file_error = $_FILES['file']['error'][$i];

        if ($file_error !== UPLOAD_ERR_OK) {
            $responses[] = "Error pada file '$file_name': Kode error $file_error.";
            continue;
        }

        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $errors = array();

        // Validasi 1: Ekstensi
        if (in_array($file_ext, $allowed_extensions) === false) {
            $errors[] = "Ekstensi file '$file_name' tidak diizinkan (hanya JPG, JPEG, PNG, GIF).";
        }

        // Validasi 2: Ukuran (misal tetap maks 2MB)
        if ($file_size > 2097152) {
            $errors[] = "Ukuran file '$file_name' tidak boleh lebih dari 2 MB.";
        }

        // Validasi 3 (PENTING): Cek apakah file benar-benar gambar
        // getimagesize() akan return false jika file bukan gambar
        if (empty($errors) == true) {
            if (getimagesize($file_tmp) === false) {
                 $errors[] = "File '$file_name' bukan file gambar yang valid.";
            }
        }


        // Jika lolos semua validasi, pindahkan file
        if (empty($errors) == true) {
            // Opsional: Buat nama file unik untuk menghindari tumpang tindih
            // $new_file_name = uniqid('', true) . '.' . $file_ext;
            // if (move_uploaded_file($file_tmp, $upload_path . $new_file_name)) {

            // Atau gunakan nama asli:
            if (move_uploaded_file($file_tmp, $upload_path . $file_name)) {
                $responses[] = "Gambar '$file_name' berhasil diunggah.";
            } else {
                $responses[] = "Gagal memindahkan gambar '$file_name'.";
            }
        } else {
            $responses = array_merge($responses, $errors);
        }
    }

    echo implode("<br>", $responses);

} else {
    echo "Tidak ada file yang diunggah.";
}
?>