<?php
include "../config/koneksi.php";

$id = $_GET['id'];

// hapus sub kriteria dulu (biar tidak error foreign key)
mysqli_query($koneksi,
    "DELETE FROM sub_kriteria WHERE id_kriteria='$id'"
);

// baru hapus kriteria
mysqli_query($koneksi,
    "DELETE FROM kriteria WHERE id_kriteria='$id'"
);

header("location:kelola_bobot.php");
?>
