<?php

session_start();
require_once("veritabani.php");

$urun_id = $_POST['urun_id'];
$urun_yeni_adet = $_POST['urun_yeni_adet'];

$sorgu = $bag->prepare("UPDATE sepet SET adet=? WHERE id='{$urun_id}'");
$sorgu->execute([$urun_yeni_adet]);

$sorgu = "SELECT SUM(sepet.adet * urun.fiyat) AS sepetToplamFiyat "
        . "FROM sepet, urun "
        . "WHERE sepet.urun_id = urun.id "
        . "AND sepet.uye_id = '{$_SESSION["id"]}'";
echo $bag->query($sorgu)->fetchColumn();
