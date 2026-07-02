<?php
include "cek_session.php";
include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM masyarakat WHERE id_masyarakat='$id'");

header("location:masyarakat.php");
?>
