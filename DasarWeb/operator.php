<?php
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo"hasil tambah: $hasilTambah <br>";
echo"hasil kurang: $hasilKurang <br>";
echo"hasil kali: $hasilKali <br>";
echo"hasil bagi: $hasilBagi <br>";
echo"hasil sisa bagi: $sisaBagi <br>";
echo"hasil pangkat: $pangkat <br><br>";

//lanjut
$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

echo"hasil Sama: $hasilSama <br>";
echo"hasil Tidak sama: $hasilTidakSama<br>";
echo"hasil lebih kecil: $hasilLebihKecil <br>";
echo"hasil lenih besar: $hasilLebihBesar <br>";
echo"hasil lebih kecil sama: $hasilLebihKecilSama <br>";
echo"hasil lebih besar sama: $hasilLebihBesarSama <br><br>";
//lanjut
$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

echo"hasil AND: $hasilAnd <br>";
echo"hasil OR: $hasilOr<br>";
echo"hasil NOT A: $hasilNotA <br>";
echo"hasil NOT B: $hasilNotB <br><br>";
//lanjuttt
$a += $b;
echo"nilai a: $a <br>";
$a -= $b;
echo"nilai a: $a <br>";
$a *= $b;
echo"nilai a: $a <br>";
$a /= $b;
echo"nilai a: $a <br>";
$a %= $b;
echo"nilai a: $a <br><br>";

//lanjut
$hasilIdentik = $a === $b;
echo"hasil identik: $hasilIdentik <br>";
$hasilTidakIdentik = $a !== $b;
echo"hasil tidak identik: $hasilTidakIdentik <br>";
?>