<?php

$sunucu = "localhost";
$veritabani = "eticaret";
$kullanici = "root";
$sifre = "root";

try {
  $bag = new PDO("mysql:host=$sunucu;dbname=$veritabani", $kullanici, $sifre);
  // PDO hata modlarını ayarlama
  $bag->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Bağlantı başarılı";
  //$bag = null;
} catch (PDOException $hata) {
  echo "Bir hata oluştu: " . $hata->getMessage();
}

function kategoriMenu($ustID = 0) {
  global $bag;
  $kategoriler = $bag->query("SELECT * FROM kategori WHERE ust_id='{$ustID}'")->fetchAll(PDO::FETCH_ASSOC);
  $sonuc = "";
  foreach ($kategoriler as $kategori) {
    $sonuc .= '<li>';
    $sonuc .= '<a href="#kategori_' . $kategori['id'] . '" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">' . $kategori['isim'] . '</a>';
    $sonuc .= '<ul class="collapse list-unstyled" id="kategori_' . $kategori["id"] . '">';
    $sonuc .= '<a href="?sayfa=anasayfa&kategori=' . $kategori['id'] . '">' . $kategori['isim'] . ' Ürünleri</a>';
    $sonuc .= kategoriMenu($kategori['id']);
    $sonuc .= "</ul>";
    $sonuc .= "</li>";
  }
  return $sonuc;
}

function urunKategoriler($ID = 0) {
  global $bag;
  $sonuc = $ID . ",";
  $kategoriler = $bag->query("SELECT * FROM kategori WHERE ust_id='{$ID}'")->fetchAll(PDO::FETCH_ASSOC);

  foreach ($kategoriler as $kategori) {
    $sonuc .= $kategori['id'] . ",";
    $sonuc .= urunKategoriler($kategori["id"]);
  }
  return $sonuc;
}

function sepeteEkle($urun_id) {
  $mesaj = "";
  if ($_SESSION["login"] == "tamam") {
    $uye_id = $_SESSION["id"];
    $adet = $bag->query("SELECT adet FROM sepet WHERE uye_id='{$uye_id}' AND urun_id='{$urun_id}'")->fetchColumn();
    if ($adet > 0) { // bu ürün sepette var adeti değiştir
      $sorgu = $bag->prepare("UPDATE sepet SET adet=:a WHERE uye_id='{$uye_id}' AND urun_id='{$urun_id}'");
      $sonuc = $sorgu->execute(array("a" => $adet++));
      $mesaj = $sonuc ? "Ürün adeti güncellendi" : "Ürün adeti güncellemede hata oluştu!";
    } else { // bu ürün sepette yok ekeleyelim
      $sorgu = $bag->prepare("INSERT INTO sepet(uye_id, urun_id, adet) VALUES(?,?,?)");
      $sorgu->execute(array($uye_id, $urun_id, 1));
      $mesaj = "Ürün sepete eklendi...";
    }
  } else {
    $mesaj = "Login olmamış!";
  }
  return $mesaj;
}
