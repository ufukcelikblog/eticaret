<?php

session_start();
require_once("veritabani.php");

if ($_SESSION["login"] == "tamam") {
  $uye_id = $_SESSION["id"];
  $sorgu = "SELECT COUNT(*) FROM sepet WHERE uye_id='{$uye_id}'";
  $adet = $bag->query($sorgu)->fetchColumn();
  if ($adet > 0) {
    echo '<a class="nav-link" href="index.php?sayfa=sepet">
            <i class="fas fa-shopping-cart text-gray-400"></i>
            <span class="badge badge-warning"> ' . $adet . ' </span>
          </a>';
  } else {
    echo '<i class="fas fa-shopping-cart text-gray-400"></i>
            <span class="badge badge-warning"> BOŞ </span>';
  }
} else {
    echo '<i class="fas fa-shopping-cart text-gray-400"></i>';
}


