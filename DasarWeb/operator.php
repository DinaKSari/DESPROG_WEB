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
echo"hasil pangkat: $pangkat <br>";

//lanjut
$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;
?>