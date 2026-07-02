<?php
include "../config/koneksi.php";

$id = $_GET['id'];

/* CEK apakah sub kriteria dipakai di penilaian */
$cek = mysqli_query($koneksi, "
    SELECT * FROM penilaian 
    WHERE c1='$id' OR c2='$id' OR c3='$id'
");

if(mysqli_num_rows($cek) > 0){
    echo "<script>
        alert('Sub kriteria tidak bisa dihapus karena sudah digunakan!');
        window.location='kelola_kriteria.php';
    </script>";
    exit;
}

/* HAPUS */
mysqli_query($koneksi, "
    DELETE FROM sub_kriteria 
    WHERE id_sub='$id'
");

header("location:kelola_kriteria.php");
?>
