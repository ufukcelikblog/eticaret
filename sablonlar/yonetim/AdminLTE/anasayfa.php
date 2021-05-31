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
      <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <?php
              $bekleyenSiparisler = $bag->query("SELECT COUNT(*) FROM siparis WHERE durum='Onay Bekliyor'")->fetchColumn();
              ?>
              <div class="inner">
                <h3><?= $bekleyenSiparisler ?> Adet</h3>
                <p>Onay Bekleyen Sipariş</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="?sayfa=siparisler" class="small-box-footer">Detaylar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <?php
              $onaylananSiparisler = $bag->query("SELECT COUNT(*) FROM siparis WHERE durum='Onaylandı'")->fetchColumn();
              ?>
              <div class="inner">
                <h3><?= $onaylananSiparisler ?> Adet</h3>
                <p>Onaylanan Sipariş</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="?sayfa=siparisler" class="small-box-footer">Detaylar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <?php
              $kargolananSiparisler = $bag->query("SELECT COUNT(*) FROM siparis WHERE durum='Kargoya Verildi'")->fetchColumn();
              ?>
              <div class="inner">
                <h3><?= $kargolananSiparisler ?> Adet</h3>
                <p>Kargoya Verilen Sipariş</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="?sayfa=siparisler" class="small-box-footer">Detaylar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <?php
              $uyeSayisi = $bag->query("SELECT COUNT(*) FROM uye WHERE tur='normal'")->fetchColumn();
              ?> 
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Üye Sayısı</span>
                <span class="info-box-number"><?= $uyeSayisi ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
                   
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Anasayfa</h3>

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
          Anasayfa
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