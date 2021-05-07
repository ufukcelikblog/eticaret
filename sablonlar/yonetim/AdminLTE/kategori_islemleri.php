<?php
if ($_SESSION["admin_login"] != "tamam") {
  header("Location: index.php?sayfa=giris");
} else {
  $mesaj = "";
  $buttonText = "EKLE";
  $islemBaslik = "Yeni Kategori";
  $islem = (isset($_GET['islem']) && $_GET['islem'] != '') ? $_GET['islem'] : '';
  $kid = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
  $kust = (isset($_GET['ustkategori']) && $_GET['ustkategori'] != '') ? $_GET['ustkategori'] : '';
  $kisim = (isset($_GET['isim']) && $_GET['isim'] != '') ? $_GET['isim'] : '';
  switch ($islem) {
    case "sil":
      $sorgu = "DELETE FROM kategori WHERE id = '{$kid}'";
      $silme = $bag->prepare($sorgu);
      $silme->execute();
      if ($silme->rowCount() > 0) {
        $mesaj = "Silme işlemi gerçekleşti";
      } else {
        $mesaj = "Silme işleminde problem oldu!!!";
      }
      break;
    case "ekle":
      $islemBaslik = "Yeni Kategori";
      $sorgu = "SELECT COUNT(*) FROM kategori WHERE ustkategori='{$kust}' AND isim='{$kisim}'";
      $adet = $bag->query($sorgu)->fetchColumn();
      if ($adet > 0) {
        $mesaj = "Bu kategori daha önce oluşturulmuş!!!";
      } else {
        $sorgu = $bag->prepare("INSERT INTO kategori(ustkategori, isim) VALUES(?,?)");
        $sorgu->execute(array($kust, $kisim));
        $mesaj = "Yeni bir kategori eklendi...";
      }
      break;
    case "guncellemeYap":
      if ($kid != '' && $kust != '' && $kisim != '') {
        $sorgu = $bag->prepare("UPDATE kategori SET ustkategori=:yust, isim=:yisim WHERE id = '{$kid}'");
        $sonuc = $sorgu->execute(array("yust" => $kust, "yisim" => $kisim));
        if ($sonuc) {
          $mesaj = "Güncelleme işlemi gerçekleşti";
        } else {
          $mesaj = "Güncelleme işleminde bir hata oluştu";
        }
      } else {
        $mesaj = "Güncelleme işleminde eksik veri var!";
      }
      $islem = "ekle";
      $islemBaslik = "Yeni Kategori";
      $kid = '';
      $kust = '';
      $kisim = '';
      break;
    case "guncellemeBaslat":
      if ($kid != '' && $kust != '' && $kisim != '') {
        $islem = "guncellemeYap";
        $islemBaslik = "Kategori Güncelleme";
        $buttonText = "GÜNCELLE";
      } else {
        $mesaj = "Güncelleme için veriler eksik !!!";
      }
      break;
    default :
      $buttonText = "EKLE";
      $islemBaslik = "Yeni Kategori";
      $islem = "ekle";
      break;
  }

  $sorgu = $bag->prepare("SELECT * FROM kategori ORDER BY id DESC");
  $sorgu->execute();
  $kategoriler = $sorgu->fetchAll();
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kategori İşlemleri</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?sayfa=anasayfa">Anasayfa</a></li>
              <li class="breadcrumb-item active">Kategori İşlemleri</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
        if ($mesaj != "") {
          ?>
          <div class="alert alert-primary text-center fade show" role="alert">
            <strong>MESAJ : </strong> <?php echo $mesaj; ?>
          </div>
          <?php
        }
        ?>
        
        <div class="row">
          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><?php echo $islemBaslik; ?></h3>
              </div>
              <!-- form start -->
              <form method="get" action="">                  
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="sayfa" class="form-control" value="kategori_islemleri"/>
                    <input type="hidden" name="islem" class="form-control" value="<?php echo $islem; ?>"/>
                    <input type="hidden" name="id" class="form-control" value="<?php echo $kid; ?>"/>  
                  </div>
                  <div class="form-group">
                    <label>Üst Kategori</label>
                    <select name="ustkategori" class="form-control">
                      <option value="0">YOK</option>
                      <?php
                      echo altKategoriler(null, null, $kust);
                      ?>
                    </select>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>İsim</label>
                    <input type="text" name="isim" class="form-control" 
                    <?php
                    if ($islem == "guncellemeYap") {
                      echo 'value="' . $kisim . '"';
                    } else {
                      echo 'placeholder="Kategori ismi giriniz" required';
                    }
                    ?>
                           >
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $buttonText; ?></button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kategoriler Tablosu</h3>
                <div class="card-tools">

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Üst Kategori</th>
                      <th>İsim</th>
                      <th class="text-center">İŞLEMLER</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (kategoriTablosu() as $kategori): ?>
                      <tr>
                        <td><?= $kategori["id"] ?></td>
                        <td><?= $kategori["ustkategori"] ?></td>
                        <td><?= $kategori["kategori"] ?></td>
                        <td class="text-center">
                          <a href="index.php?sayfa=kategori_islemleri&islem=guncellemeBaslat&id=<?= $kategori['id'] ?>&ustkategori=<?= $kategori['ustkategori'] ?>&isim=<?= $kategori['isim'] ?>">
                            <button class="btn btn-info btn-xs">
                              <i class="fas fa-pencil-alt"></i>
                              GÜNCELLE
                            </button>
                          </a>
                          -
                          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-sil">
                            <i class="fas fa-trash"></i>
                            SİL
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
      <div class="modal fade" id="modal-sil">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Kategori Silme</h4>
            </div>
            <div class="modal-body">
              <p>Silmek istediğinize emin misiniz?</p>
              <p>Bu işlem geri alınamaz!</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                <i class="fas fa-undo"></i>
                Vazgeç
              </button>
              <a href="index.php?sayfa=kategori_islemleri&islem=sil&id=<?= $kategori['id'] ?>">
                <button type="button" class="btn btn-outline-light">
                  <i class="fas fa-trash"></i>
                  SİL
                </button>
              </a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
}