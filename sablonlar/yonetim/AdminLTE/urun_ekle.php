<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ürün İşlemleri - Yeni Ürün</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php?sayfa=anasayfa">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="index.php?sayfa=urun_islemleri">Ürün İşlemleri</a></li>          
            <li class="breadcrumb-item active">Yeni Ürün</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Yeni Ürün</h3>
          </div>
          <!-- form start -->
          <form method="post" action="">
            <div class="card-body">
              <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" class="form-control">
                  <option value="0">YOK</option>
                  <?php
                  foreach ($kategoriler as $kategori) {
                    $secilmeDurum = $kust == $kategori["id"] ? "selected" : "";
                    echo '<option value="' . $kategori["id"] . '" ' . $secilmeDurum . '>' . $kategori["ustkategori"] . ' -> ' . $kategori["isim"] .'</option>';
                  }
                  ?>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>İsim</label>
                <input type="text" name="isim" class="form-control" placeholder="Ürün adı giriniz..." required>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Satış Fiyat</label>
                <input type="text" name="isim" class="form-control" placeholder="Satış fiyatı değerini giriniz..." required>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Durum</label>
                <select name="durum" class="form-control">
                  <option value="Satışta">Satışta</option>
                  <option value="Beklemede">Beklemede</option>
                  <option value="Stokta Yok">Stokta Yok</option>
                  <option value="Kampanya">Kampanya</option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><?php echo $buttonText; ?></button>
            </div>
            <!-- /.card-body -->
          </form>
          <div class="card-footer">

          </div>
        </div>
        <!-- /.card -->
      </div>

    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->