<?php
//membuat fungsi
function perkenalan ($nama, $salam){
echo $salam.", ";
echo "Perkenalkan, nama saya ".$nama."<br/>";
echo "Senang berkenalan dengan Anda<br/>";
}
//memanggil fungsi yang sudah dibuat
perkenalan ("Dina", "Hallo");
echo "<hr>";
$saya = "Bimbango";
$ucapanSalam = "Selamat pagi";
//memanggil lagi
perkenalan($saya, $ucapanSalam);
?>