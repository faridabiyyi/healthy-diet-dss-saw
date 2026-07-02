<?php
include "cek_session.php";
include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM penilaian WHERE id_penilaian='$id'");

header("location:penilaian.php");
?>
