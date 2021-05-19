<!-- Footer -->
<footer class="py-5 bg-dark">
  <div class="container">
    <p class="m-0 text-center text-white">Telif &copy; 2021 E-Ticaret</p>
  </div>
  <!-- /.container -->
</footer>

<!-- Bootstrap core JS-->
<!-- Burada jquery.slim.min kaldırıyoruz. Çünkü AJAX desteklemiyor-->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?= SITE_SABLON ?>/js/scripts.js"></script>
<script type="text/javascript">
  $('.sepet-dugme').click(function (e) {
    e.preventDefault();
    var urun_id = $(this).parent().data('id');

    $.ajax({
      type: 'POST',
      url: '../eticaret/kutuphane/sepet_islemleri.php',
      data: {
        urun_id: urun_id
      },
      success: function (result)
      {
        $('#modal-container').html(result);
        // Display Modal
        $('#sepet-modal').modal('show');
      },
      error: function (result) {
        $('#modal-container').html(result);
        // Display Modal
        $('#sepet-modal').modal('show');
      }
    });
  });
</script>