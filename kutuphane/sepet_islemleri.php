<?php

session_start();
require_once("veritabani.php");

if (isset($_POST['urun_id'])) {
  $urun_id = $_POST['urun_id'];
  if ($_SESSION["login"] == "tamam") {
    $uye_id = $_SESSION["id"];
    $kayit = $bag->prepare("SELECT * FROM sepet WHERE uye_id=? AND urun_id=?");
    $kayit->execute(array($uye_id, $urun_id));
    if ($kayit->rowCount() > 0) { // bu ürün sepette var adeti değiştir
      $sorgu = $bag->prepare("UPDATE sepet SET adet=adet+1 WHERE uye_id=? AND urun_id=?");
      $sonuc = $sorgu->execute([$uye_id, $urun_id]);
      echo $sonuc ? "Ürün adeti güncellendi" : "Ürün adeti güncellemede hata oluştu!";
    } else { // bu ürün sepette yok ekleyelim
      $sorgu = $bag->prepare("INSERT INTO sepet(uye_id, urun_id, adet) VALUES(?,?,?)");
      $sorgu->execute(array($uye_id, $urun_id,'1'));
      echo "Ürün sepete eklendi...";
    }
  } else {
    echo "Login olmamış!";
  }
} else {
  echo "Seçilen bir ürün yok!";
}