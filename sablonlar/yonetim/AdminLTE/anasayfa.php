<?php
if ($_SESSION["admin_login"] != "tamam") {
  header("Location: index.php?sayfa=giris");
} else {
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Anasayfa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Son Siparişler</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Tarih</th>
                <th>Üye</th>
                <th>Ürün</th>
                <th>Adet</th>
                <th>Fiyat</th>
                <th>Toplam</th>
                <th>Durum</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $kayitlar = $bag->query("SELECT * FROM siparis ORDER BY tarih DESC", PDO::FETCH_ASSOC);
              foreach ($kayitlar as $kayit):
                $urun_id = $kayit['urun_id'];
                $uye_isim = $bag->query("SELECT CONCAT(ad, ' ', soyad) AS isim FROM uye WHERE id='{$kayit['uye_id']}'")->fetchColumn();
                $urun_isim = $bag->query("SELECT isim FROM urun WHERE id='{$kayit['urun_id']}'")->fetchColumn();
                $urun_adet = $kayit['adet'];
                $urun_fiyat = $bag->query("SELECT fiyat FROM urun WHERE id='{$kayit['urun_id']}'")->fetchColumn();
                $urun_toplam_fiyat = $urun_adet * $urun_fiyat;
                ?>
                <tr>
                  <td><?= $kayit['tarih'] ?></td>
                  <td><?= $uye_isim ?></td>
                  <td><?= $urun_isim ?></td>
                  <td><?= $urun_adet ?></td>
                  <td><?= $urun_fiyat ?></td>
                  <td><?= $urun_toplam_fiyat ?></td>
                  <td><?= $kayit['durum'] ?></td>
                </tr>
                <?php
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
}