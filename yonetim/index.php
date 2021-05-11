<?php

// Yönetici sitesi başlangıç

require_once("../kutuphane/ayarlar.php");
require_once("../kutuphane/oturum.php");
require_once("../kutuphane/veritabani.php");

$sayfa = (isset($_GET['sayfa']) && $_GET['sayfa'] != '') ? $_GET['sayfa'] : '';

switch ($sayfa) {
  case 'giris' :
    $baslik = "Giriş";
    $icerik = 'giris.php';
    break;
  case 'cikis' :
    $baslik = "Çıkış";
    $icerik = 'cikis.php';
    break;
  case 'kategori_islemleri' :
    $baslik = "Kategori İşlemleri";
    $icerik = 'kategori_islemleri.php';
    break;
  default :
    $baslik = "Anasayfa";
    $icerik = 'anasayfa.php';
}

require_once(YONETIM_SABLON . "/sablon.php");

