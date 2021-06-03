<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
  <?php
  require YONETIM_SABLON . '/head.php';
  ?>
  <body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
  <div class="wrapper">
    <?php
    require YONETIM_SABLON . '/navbar.php';

    require YONETIM_SABLON . '/sidebar.php';

    require $icerik;

    require YONETIM_SABLON . '/footer.php';
    ?>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo YONETIM_SABLON; ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo YONETIM_SABLON; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo YONETIM_SABLON; ?>/plugins/select2/js/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo YONETIM_SABLON; ?>/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo YONETIM_SABLON; ?>/dist/js/demo.js"></script>
  <!-- Summernote -->
  <script src="<?php echo YONETIM_SABLON; ?>/plugins/summernote/summernote-bs4.min.js"></script>

  <script type="text/javascript">
    $(function () {
      // Summernote
      $('#summernote').summernote()

    });
    
    $('#modal-sil').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var link = button.data("href");
      var modal = $(this);
      modal.find(".modal-footer a").attr("href", link);
    });
  </script>
</body>
</html>
<?php
ob_flush();
?>