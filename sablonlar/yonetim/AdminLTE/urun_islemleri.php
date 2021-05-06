<?php

if ($_SESSION["admin_login"] != "tamam") {
  header("Location: index.php?sayfa=giris");
} else {
  $islem = (isset($_GET['islem']) && $_GET['islem'] != '') ? $_GET['islem'] : 'ekle';
  $sorgu = $bag->prepare("SELECT * FROM kategori");
  $sorgu->execute();
  $kategoriler = $sorgu->fetchAll();
  
  require "urun_" . $islem . ".php";
}





