$(document).ready(function () {

  $('#modal-sil').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var link = button.data("href");
    var modal = $(this);
    modal.find(".modal-footer a").attr("href", link);
  });

  $('#modal-temizle').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var link = button.data("href");
    var modal = $(this);
    modal.find(".modal-footer a").attr("href", link);
  });

  $(document).on('click', '.list-down-btn', function (event) {
    event.preventDefault();
    var target = $(this).attr('data-toggle');
    $(target).slideToggle();
    var clicked = event.target;
    $(clicked).toggleClass("fa-chevron-down fa-chevron-up");
  });

  function sepet_bilgisi() {
    $.ajax({
      url: "../eticaret/kutuphane/sepet_bilgisi.php",
      method: "POST",
      success: function (data)
      {
        $('#sepet-bilgi').html(data);
      }
    });
  }

  $('.sepet-ekle').click(function (e) {
    e.preventDefault();
    var urun_id = $(this).parent().data('id');
    $.ajax({
      type: 'POST',
      url: '../eticaret/kutuphane/sepet_ekle.php',
      data: {
        urun_id: urun_id
      },
      success: function (sonuc)
      {
        sepet_bilgisi();
        $('#modal-container').html(sonuc);
        // Display Modal
        $('#sepet-modal').modal('show');
      },
      error: function (sonuc) {
        $('#modal-container').html(sonuc);
        // Display Modal
        $('#sepet-modal').modal('show');
      }
    });
  });

  sepet_bilgisi();
  
});