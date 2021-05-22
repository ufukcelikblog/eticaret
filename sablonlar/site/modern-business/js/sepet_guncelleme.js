
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

function urunAdetAzalt(urun_id, urun_fiyat) {
  var urunAdetEleman = $("#urun_" + urun_id + "_adet");
  var urunAdet = parseInt($(urunAdetEleman).val());
  if (urunAdet > 1) {
    var yeniAdet = urunAdet - 1;
    var yeniUrunToplamFiyat = yeniAdet * urun_fiyat;
    sepet_urun_guncelle(urun_id, yeniAdet, yeniUrunToplamFiyat);
  }
}

function urunAdetCogalt(urun_id, urun_fiyat) {
  var urunAdetEleman = $("#urun_" + urun_id + "_adet");
  var urunAdet = parseInt($(urunAdetEleman).val());
  var yeniAdet = urunAdet + 1;
  var yeniUrunToplamFiyat = yeniAdet * urun_fiyat;
  sepet_urun_guncelle(urun_id, yeniAdet, yeniUrunToplamFiyat);
}

function sepet_urun_guncelle(urun_id, yeni_adet, yeni_fiyat) {
  var urunAdetEleman = $("#urun_" + urun_id + "_adet");
  var urunToplamFiyatEleman = $("#urun_" + urun_id + "_toplam_fiyat");
  var sepetToplamFiyatEleman = $("#sepetToplamFiyat");
  $.ajax({
    url: "../eticaret/kutuphane/sepet_guncelle.php",
    data: "urun_id=" + urun_id + "&urun_yeni_adet=" + yeni_adet,
    type: 'post',
    success: function (sepetToplamFiyat) {
      $(urunAdetEleman).val(yeni_adet);
      $(urunToplamFiyatEleman).text(yeni_fiyat);
      $(sepetToplamFiyatEleman).text(sepetToplamFiyat);
      sepet_bilgisi();
    }
  });
}