
function urunAdetAzalt(urun_id, urun_fiyat) {
  var urunAdetEleman = $("#urun_" + urun_id + "_adet");
  var yeniAdet = parseInt($(urunAdetEleman).val()) - 1;
  var yeniUrunToplamFiyat = yeniAdet * urun_fiyat;
  sepet_urun_guncelle(urun_id, yeniAdet, yeniUrunToplamFiyat);
}

function urunAdetCogalt(urun_id, urun_fiyat) {
  var urunAdetEleman = $("#urun_" + urun_id + "_adet");
  var yeniAdet = parseInt($(urunAdetEleman).val()) + 1;
  var yeniUrunToplamFiyat = yeniAdet * urun_fiyat;
  sepet_urun_guncelle(urun_id, yeniAdet, yeniUrunToplamFiyat);
}

function sepet_urun_guncelle(urun_id, yeni_adet, yeni_fiyat) {
  var urunAdetEleman = $("#urun_" + urun_id + "_adet");
  var urunToplamFiyatEleman = $("#urun_" + urun_id + "_toplam_fiyat");
  $.ajax({
    url: "../eticaret/kutuphane/sepet_guncelle.php",
    data: "urun_id=" + urun_id + "&urun_yeni_adet=" + yeni_adet,
    type: 'post',
    success: function (response) {
      $(urunAdetEleman).val(yeni_adet);
      $(urunToplamFiyatEleman).text(yeni_fiyat);
    }
  });
}