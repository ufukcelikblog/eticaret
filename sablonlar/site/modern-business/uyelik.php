<?php
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
} else {
  $mesaj = "";
  if (isset($_POST["kayit"])) {
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $eposta = $_POST["eposta"];
    $sifre = $_POST["sifre"];

    $sorgu = $bag->prepare("SELECT id FROM uye WHERE eposta = ?");
    $sorgu->execute([$eposta]);
    if ($sorgu->rowCount() > 0) {
      $mesaj = "Bu e-posta ile daha önce kayıt olunmuş..";
      $mesajTur = "HATA";
    } else {
      $sorgu = $bag->prepare("INSERT INTO uye(ad, soyad, eposta, sifre) VALUES(?,?,?,?)");
      $sorgu->execute(array($ad, $soyad, $eposta, $sifre));
      $mesaj = "Kayıt başarılı. Giriş yapabilirsiniz";
    }
  }

  if (isset($_POST["giris"])) {
    $eposta = $_POST["eposta"];
    $sifre = $_POST["sifre"];
    $sorgu = $bag->prepare("SELECT * FROM uye WHERE eposta = ? AND sifre = ?");
    $sorgu->execute(array($eposta, $sifre));
    $sonuc = $sorgu->fetch();
    if ($sonuc) {
      $mesaj = "Giriş Başarılı";
      $_SESSION["login"] = "tamam";
      $_SESSION["id"] = $sonuc["id"];
      $_SESSION["ad"] = $sonuc["ad"];
      $_SESSION["soyad"] = $sonuc["soyad"];
      $_SESSION["eposta"] = $sonuc["eposta"];
      $_SESSION["sifre"] = $sonuc["sifre"];
      $_SESSION["tur"] = $sonuc["tur"];
    } else {
      $mesaj = "Hatalı e-posta veya şifre !";
    }
  }

  if (isset($_POST["unutma"])) {
    $eposta = $_POST["eposta"];
    $sorgu = $bag->prepare("SELECT sifre FROM uye WHERE eposta = ?");
    $sorgu->execute([$eposta]);
    $unutulanSifre = $sorgu->fetch(PDO::FETCH_ASSOC);
    if ($sorgu->rowCount() > 0) {
      $konu = "Şifreniz hakkında";
      $mesaj = "Unuttuğunuz şifreniz : " . $unutulanSifre;
      mail($eposta, $konu, $mesaj, "From: $eposta");
      $mesaj = "Şifreniz e-posta adresinize gönderilmiştir.";
    } else {
      $mesaj = "Hatalı e-posta!";
    }
  }
  ?>
<!-- Page Content-->
<div class="container">
  <!-- Page Heading/Breadcrumbs -->
  <h1 class="mt-4 mb-3">E-Ticaret Sitesi
    <small><?php echo $baslik; ?></small>
  </h1>

  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.php">Anasayfa</a>
    </li>
    <li class="breadcrumb-item active">
      Üyelik
    </li>
  </ol>
  <?php
  if ($mesaj != "") {
    ?>
    <div class="alert alert-primary text-center fade show" role="alert">
      <strong>MESAJ : </strong> <?php echo $mesaj; ?>
    </div>
    <?php
    if ($mesaj == "Giriş Başarılı") {
      ?>
      <script>
        setInterval(
                function () {
                  window.location.href = "index.php";
                }, 2000
                );
      </script>
      <?php
    }
  }
  ?>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs nav-justified card-header-tabs">
            <li class="nav-item">
              <a class="nav-link" href="#kayit" data-toggle="tab">Kayıt</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#giris" data-toggle="tab">Giriş</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#unutma" data-toggle="tab">Şifremi Unuttum</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="container tab-pane fade" id="kayit">
              <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="ad">Ad:</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="text" name="ad" placeholder="adınızı yazınız" required>	
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="ad">Soyad:</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="text" name="soyad" placeholder="soyadınızı yazınız" required>	
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="eposta">E-posta:</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="email" name="eposta" placeholder="geçerli bir e-posta yazınız" required>	
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="sifre">Şifre:</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="password" name="sifre" placeholder="şifrenizi yazınız" required>	
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary btn-block" name="kayit">KAYDOL</button>
                </div>	
              </form>
            </div>
            <div class="container tab-pane active" id="giris">
              <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="eposta">E-posta:</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="email" name="eposta" placeholder="e-posta adresinizi yazınız" required>	
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="sifre">Şifre:</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="password" name="sifre" placeholder="şifrenizi yazınız" required>	
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary btn-block" name="giris">GİRİŞ</button>
                </div>
              </form>
            </div>
            <div class="container tab-pane fade" id="unutma">
              <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="eposta">E-posta:</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="email" name="eposta" placeholder="kayıtlı olduğunuz e-posta adresinizi yazınız" required>	
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary btn-block" name="unutma">GÖNDER</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php
}
