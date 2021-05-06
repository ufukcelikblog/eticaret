<?php

$sunucu = "localhost";
$veritabani = "eticaret";
$kullanici = "root";
$sifre = "mysql";

try {
  $bag = new PDO("mysql:host=$sunucu;dbname=$veritabani", $kullanici, $sifre);
  // PDO hata modlarını ayarlama
  $bag->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Bağlantı başarılı";
  //$bag = null;
} catch (PDOException $hata) {
  echo "Bir hata oluştu: " . $hata->getMessage();
}

function kategoriDizisi(array $kategoriler, $id = 0) {
  $liste = array();
  foreach ($kategoriler as $kategori) {
    if ((int) $kategori['ustkategori'] == $id) {
      if ($altkategori = kategoriDizisi($kategoriler, $kategori['id'])) {
        $kategori['altkategori'] = $altkategori;
      }
      $liste[] = $kategori;
    }
  }
  return $liste;
}

function bosluk($adet) {
  $sonuc = "";
  for ($b = 1; $b <= $adet; $b++) {
    $sonuc .= "&nbsp;&nbsp;&nbsp;";
  }
  $sonuc .= "";
  return $sonuc;
}

function kategoriOptionOlustur(array $kategoriDizisi, $bosluk = false, $seviye = 0) {
  $seviye++;
  $sonuc = "";
  if (count($kategoriDizisi) > 0) {
    $boslukDegeri = $bosluk ? bosluk($seviye) : "";
    foreach ($kategoriDizisi as $kategori) {
      $sonuc .= "<option value='" . $kategori["id"] . "'>|" . $boslukDegeri . "|_ " . $kategori["isim"] . "</option>";
      if (isset($kategori["altkategori"])) {
        $sonuc .= kategoriOptionOlustur($kategori["altkategori"], true, $seviye);
      }
    }
  }
  return $sonuc;
}

function altKategoriler($ustID = 0, $ustIsim = "Ana Kategori") {
  global $bag;
  $sorgu = $bag->prepare("SELECT * FROM kategori WHERE ustkategori ='{$ustID}'");
  $sorgu->execute();
  $kategoriler = $sorgu->fetchAll();

  $sonuc = "";
  foreach ($kategoriler as $kategori) {
    $altIsim = $ustIsim;
    $sonuc .= "<option value='" . $kategori["id"] . "'>" . $altIsim . " > " . $kategori["isim"] . "</option>";
    $altIsim .= " > " . $kategori["isim"];
    $sonuc .= altKategoriler($ustID = $kategori["id"], $altIsim);
  }
  return $sonuc;
}
