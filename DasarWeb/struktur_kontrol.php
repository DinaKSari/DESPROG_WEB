<?php
$nilaiNumerik = 92;

if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) {
    echo "Nilai huruf: A";
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik < 90) {
    echo "Nilai huruf: B";
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik < 80) {
    echo "Nilai huruf: C";
} elseif ($nilaiNumerik < 70) {
    echo "Nilai huruf: D";
}
//lanjut
$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while ($jarakSaatIni < $jarakTarget) {
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}

echo "<br><br>Atlet tersebut memerlukan $hari hari untuk mencapai jarak 500 kilometer.";
//lanjutt
$jumlahLahan = 10;
$tanamanPerLahan = 5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for ($i = 1; $i <= $jumlahLahan; $i++) {
    $jumlahBuah += ($tanamanPerLahan * $buahPerTanaman);
}

echo "<br><br>Jumlah buah yang akan dipanen adalah: $jumlahBuah <br><br>";
//lanjut lagii
$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $nilai) {
    if ($nilai < 60) {
        echo "Nilai: $nilai (Tidak lulus)<br>";
        continue;
    }
    echo "Nilai: $nilai (Lulus) <br>";
}
//lanjut.. lagi
$skorUjian = [85, 92, 78, 96, 88];
$totalSkor = 0;

foreach ($skorUjian as $skor) {
    $totalSkor += $skor;
}

echo "<br>Total skor ujian adalah: $totalSkor <br>";
//tugas cerita
$nilaiSiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
sort($nilaiSiswa);
$totalNilai = 0;
for ($i = 2; $i < count($nilaiSiswa) - 2; $i++) {
    $totalNilai += $nilaiSiswa[$i];
}
$rataRata = $totalNilai / 6;

echo "<br>Total nilai setelah mengabaikan dua nilai tertinggi dan terendah adalah: $totalNilai<br>";
echo "Nilai rata-rata yang digunakan adalah: $rataRata <br><br>";

//tugas cerita 2
$hargaProduk = 120000;
$syaratDiskon = 100000;
$persenDiskon = 20;
$hargaAkhir = $hargaProduk;

if ($hargaProduk > $syaratDiskon) {
    $jumlahDiskon = ($persenDiskon / 100) * $hargaProduk;
    $hargaAkhir = $hargaProduk - $jumlahDiskon;
    echo "Anda mendapatkan diskon sebesar: Rp " . $jumlahDiskon . " (20%)<br>";
}
echo "Harga yang Harus Dibayar: Rp " . $hargaAkhir;

//ceritaa 3
$poin = 620;
?>