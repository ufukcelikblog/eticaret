<?php

if ($_SESSION["admin_login"] != "tamam") {
  header("Location: index.php?sayfa=giris");
} else {
  $islem = (isset($_GET['islem']) && $_GET['islem'] != '') ? $_GET['islem'] : 'ekleme';

  require "urun_" . $islem . ".php";
}