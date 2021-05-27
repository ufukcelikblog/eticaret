<?php
if ($_SESSION["login"] != "tamam") {
  header("Location: index.php?sayfa=uyelik");
} else {
  $mesaj = "";
  $id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
  $islem = (isset($_GET['islem']) && $_GET['islem'] != '') ? $_GET['islem'] : '';

  switch ($islem) {
    case "silme":
      $sorgu = "DELETE FROM sepet WHERE id = '{$id}'";
      $silme = $bag->prepare($sorgu);
      $silme->execute();
      if ($silme->rowCount() > 0) {
        $mesaj = "Silme işlemi gerçekleşti";
      } else {
        $mesaj = "Silme işleminde problem oldu!!!";
      }
      break;
    case "temizleme":
      $sorgu = "DELETE FROM sepet WHERE uye_id = '{$_SESSION["id"]}'";
      $silme = $bag->prepare($sorgu);
      $silme->execute();
      if ($silme->rowCount() > 0) {
        $mesaj = "Sepet Temizlendi";
      } else {
        $mesaj = "Temizleme işleminde problem oldu!!!";
      }
      break;
  }
  ?>
  <!-- Page Content-->
  <div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">E-Ticaret
      <small><?php echo $baslik; ?></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Anasayfa</a>
      </li>
      <li class="breadcrumb-item active">Sipariş İşlemleri</li>
    </ol>
    <?php
    if ($mesaj != "") {
      ?>
      <div class="alert alert-warning text-center fade show" role="alert">
        <strong>MESAJ : </strong> <?php echo $mesaj; ?>
      </div>
      <?php
    }
    ?>
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Sepetiniz</span>
        </h4>
        <ul class="list-group mb-3">
          <?php
          $kayitlar = $bag->query("SELECT * FROM sepet WHERE uye_id='{$_SESSION['id']}'", PDO::FETCH_ASSOC);
          $sepetToplamAdet = 0;
          $sepetToplamFiyat = 0;
          foreach ($kayitlar as $kayit):
            $urun_id = $kayit['urun_id'];
            $urun_isim = $bag->query("SELECT isim FROM urun WHERE id='{$kayit['urun_id']}'")->fetchColumn();
            $urun_adet = $kayit['adet'];
            $sepetToplamAdet += $urun_adet;
            $urun_fiyat = $bag->query("SELECT fiyat FROM urun WHERE id='{$kayit['urun_id']}'")->fetchColumn();
            $urun_toplam_fiyat = $urun_adet * $urun_fiyat;
            $sepetToplamFiyat += $urun_toplam_fiyat;
            ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?= $urun_isim ?></h6>
                <small class="text-muted"><?= $urun_fiyat ?> TL x <?= $urun_adet ?> Adet</small>
              </div>
              <span class="text-muted"><?= $urun_toplam_fiyat ?> TL</span>
            </li>
            <?php endforeach; ?>
            <li class="list-group-item list-group-item-warning d-flex justify-content-between">
              <span>Toplam <?= $sepetToplamAdet ?> Ürün</span>
              <strong><?= $sepetToplamFiyat ?> TL</strong>
            </li>
        </ul>
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Adres Bilgileri</h4>
        <form class="needs-validation" novalidate>
          <div class="mb-3">
            <label for="adres">Adres</label>
            <input type="text" class="form-control" id="adres" name="adres" placeholder="Adresiniz" required>
              <div class="invalid-feedback">
                Lütfen adresinizi yazınız.
              </div>
          </div>
          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="sehir">Şehir</label>
              <input type="text" class="form-control" id="sehir" name="sehir" placeholder="Şehriniz" required>
                <div class="invalid-feedback">
                  Lütfen şehiri yazınız.
                </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="ilce">İlçe</label>
              <input type="text" class="form-control" id="ilce" name="ilce" placeholder="İlçeniz" required>
                <div class="invalid-feedback">
                  Lütfen ilçeyi yazınız.
                </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="posta">Posta Kodu</label>
              <input type="text" class="form-control" id="posta" name="posta" placeholder="Posta kodunuz" required>
                <div class="invalid-feedback">
                  Lütfen posta kodunu yazınız.
                </div>
            </div>
          </div>
          <hr class="mb-4">

          <h4 class="mb-3">Ödeme</h4>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="cc-isim">Kredi kartı üzerindeki isim</label>
              <input type="text" class="form-control" id="cc-isim" name="cc-isim" placeholder="" required>
                <small class="text-muted">Kredi kartı üzerindeki tam isim</small>
                <div class="invalid-feedback">
                  Kredi kartı üzerindeki isimi yazınız
                </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cc-no">Kredi kartı numarası</label>
              <input type="text" class="form-control" id="cc-no" placeholder="" required>
                <div class="invalid-feedback">
                  Kredi numarasnı yazınız
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-gecelilik">Geçerlilik Süresi</label>
              <input type="text" class="form-control" id="cc-gecerllik" name="cc-gecerllik" placeholder="AA/YY" required>
                <div class="invalid-feedback">
                  Kredi kartı geçerlilik süresini yazınız
                </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="cc-cvv">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  3 haneli güvenlik kodunu yazınız
                </div>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Siparişi Tamamla</button>
        </form>
      </div>
    </div>
  </div>
  <?php
}
?>
