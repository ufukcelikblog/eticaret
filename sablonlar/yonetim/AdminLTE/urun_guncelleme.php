<?php
$mesaj = "";
if (isset($_POST["guncelle"])) {
  $id = $_POST["id"];
  $kategori_id = $_POST["kategori_id"];
  $isim = $_POST["isim"];
  $fiyat = $_POST["fiyat"];
  $durum = $_POST["durum"];
  $aciklama = $_POST["aciklama"];

  $sorgu = $bag->prepare("UPDATE urun SET kategori_id=:k, isim=:i, fiyat=:f, durum=:d, aciklama=:a WHERE id='{$id}'");
  $sonuc = $sorgu->execute(array("k" => $kategori_id, "i" => $isim, "f" => $fiyat, "d" => $durum, "a" => $aciklama));
  if ($sonuc) {
    $mesaj = "Ürün Güncelleme işlemi gerçekleşti";
  } else {
    $mesaj = "Ürün Güncelleme işleminde bir hata oluştu";
  }
} else {
  $id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
  $kayit = $bag->query("SELECT * FROM urun WHERE id='{$id}'")->fetch(PDO::FETCH_ASSOC);
  $kategori_id = $kayit["kategori_id"];
  $isim = $kayit["isim"];
  $fiyat = $kayit["fiyat"];
  $durum = $kayit["durum"];
  $aciklama = $kayit["aciklama"];
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ürün İşlemleri - Güncelleme</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php?sayfa=anasayfa">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="index.php?sayfa=urun_islemleri">Ürün İşlemleri</a></li>
            <li class="breadcrumb-item">Düzenleme</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php
        if ($mesaj != "") {
          ?>
          <div class="alert alert-warning text-center fade show" role="alert">
            <strong>MESAJ : </strong> <?php echo $mesaj; ?>
          </div>
          <?php
          if ($mesaj == "Ürün Güncelleme işlemi gerçekleşti") {
            ?>
            <script>
              setInterval(
                      function () {
                        window.location.href = "index.php?sayfa=urun_islemleri";
                      }, 2000
                      );
            </script>
            <?php
          }
        }
        ?>
      </div>

      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Ürün #<?= $id ?> Güncelleme</h3>
          </div>
          <div class="card-body">
            <!-- form start -->
            <form class="form-horizontal" method="post" action="">
              <input type="hidden" name="id" class="form-control" value="<?= $id ?>"/>  
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                  <select name="kategori_id" class="form-control">
                    <?php
                    $kategoriler_AZ = $bag->query("SELECT * FROM kategori ORDER BY ust_id, id", PDO::FETCH_ASSOC);
                    foreach ($kategoriler_AZ as $kayit):
                      $secilmeDurum = $kayit["id"] == $kategori_id ? "selected" : "";
                      //echo "<option value='" . $kategori["id"] . "' " . $secilmeDurum . ">" . $kategori["ust_isim"] . " > " . $kategori["isim"] . "</option>";
                      ?>
                      <option value="<?= $kayit["id"] ?>" <?= $secilmeDurum ?>><?= $kayit["ust_isim"] . " > " . $kayit["isim"] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">İsim</label>
                <div class="col-sm-10">
                  <input type="text" name="isim" class="form-control" value="<?= $isim ?>">
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Satış Fiyat</label>
                <div class="col-sm-10">
                  <input type="text" name="fiyat" class="form-control" value="<?= $fiyat ?>">
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Durum</label>
                <div class="col-sm-10">
                  <select name="durum" class="form-control">
                    <option value="Satışta" <?php echo $durum == "Satışta" ? "selected" : "" ?>>Satışta</option>
                    <option value="Beklemede" <?php echo $durum == "Beklemede" ? "selected" : "" ?>>Beklemede</option>
                    <option value="Stokta Yok" <?php echo $durum == "Stokta Yok" ? "selected" : "" ?>>Stokta Yok</option>
                    <option value="Kampanya" <?php echo $durum == "Kampanya" ? "selected" : "" ?>>Kampanya</option>
                  </select>
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Açıklama</label>
                <textarea name="aciklama" rows="6" cols="10" class="form-control"><?= $aciklama ?></textarea>
              </div>
              <!-- /.form-group -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary  btn-block" name="guncelle">GÜNCELLE</button>
              </div>
              <!-- /.card-footer -->
            </form>
            <!-- form finish -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->