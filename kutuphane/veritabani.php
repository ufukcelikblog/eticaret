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

/*
function ustIsim($id) {
  global $bag;
  $kayit = $bag->query("SELECT * FROM kategori WHERE id='{$id}'")->fetch(PDO::FETCH_ASSOC);
  if ($kayit) {
    return $kayit["ust_isim"];
  } else {
    return "null";
  }
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

function altKategoriler($ustID = null, $isimler = "", $secilenID = 0) {
  global $bag;
  $sorgu = $bag->prepare("SELECT * FROM kategori WHERE ustkategori ='{$ustID}'");
  $sorgu->execute();
  $kategoriler = $sorgu->fetchAll();

  $sonuc = "";
  foreach ($kategoriler as $kategori) {
    $altIsimler = $isimler;
    $secilmeDurum = $secilenID == $kategori["id"] ? "selected" : "";
    $sonuc .= "<option value='" . $kategori["id"] . "' " . $secilmeDurum . ">" . $altIsimler . " > " . $kategori["isim"] . "</option>";
    $altIsimler .= " > " . $kategori["isim"];
    $sonuc .= altKategoriler($kategori["id"], $altIsimler, $secilenID);
  }
  return $sonuc;
}

function kategoriTablosu($ustID = 0, $isimler = "") {
  global $bag;
  $sorgu = $bag->prepare("SELECT * FROM kategori WHERE ustkategori ='{$ustID}'");
  $sorgu->execute();
  $kategoriler = $sorgu->fetchAll();

  $sonuc = array();
  foreach ($kategoriler as $kategori) {
    $altIsimler = $isimler;
    $sonuc = array("id" => $kategori[id], "kategori" => $altIsimler . " > " . $kategori["isim"]);
    $altIsimler .= " > " . $kategori["isim"];
    $sonuc = kategoriTablosu($kategori["id"], $altIsimler, $secilenID);
  }
  return $sonuc;
}

function altKategorilerT($ustID = 0, $isimler = "") {
  global $bag;
  $sorgu = $bag->prepare("SELECT * FROM kategori WHERE ustkategori ='{$ustID}'");
  $sorgu->execute();
  $kategoriler = $sorgu->fetchAll();

  $sonuc = "";
  foreach ($kategoriler as $kategori) {
    $altIsimler = $isimler;
    $sonuc .= "<option value='" . $kategori["id"] . "'>" . $altIsimler . " > " . $kategori["isim"] . "</option>";
    $altIsimler .= " > " . $kategori["isim"];
    $sonuc .= altKategoriler($ustID = $kategori["id"], $altIsimler);
  }
  return $sonuc;
}
*/