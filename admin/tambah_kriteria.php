<?php
include "cek_session.php";
include "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $kode  = mysqli_real_escape_string($koneksi, $_POST['kode']);
    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tipe  = mysqli_real_escape_string($koneksi, $_POST['tipe']);
    $bobot = mysqli_real_escape_string($koneksi, $_POST['bobot']);

    // cek kode
    $cek = mysqli_query($koneksi,"
        SELECT * FROM kriteria
        WHERE kode_kriteria='$kode'
    ");

    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Kode sudah digunakan!');</script>";
    }else{

        mysqli_query($koneksi,"
            INSERT INTO kriteria
            (kode_kriteria,nama_kriteria,tipe,bobot)
            VALUES
            ('$kode','$nama','$tipe','$bobot')
        ");

        echo "<script>
        alert('Kriteria berhasil ditambahkan!');
        window.location='kelola_bobot.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Kriteria</title>

<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<div class="container">

<center><h2>Tambah Kriteria</h2></center>

<form method="POST" class="form-card">

<label>Kode Kriteria</label>
<input type="text" name="kode" placeholder="Contoh: C4" required>

<label>Nama Kriteria</label>
<input type="text" name="nama" placeholder="Contoh: Pola Tidur" required>

<label>Tipe Kriteria</label>
<select name="tipe" required>
    <option value="">-- Pilih Tipe --</option>
    <option value="benefit">Benefit (Semakin besar semakin baik)</option>
    <option value="cost">Cost (Semakin kecil semakin baik)</option>
</select>

<label>Bobot</label>
<input type="number" step="0.01" name="bobot" placeholder="Contoh: 0.25" required>

<br>

<button type="submit" name="simpan" class="btn-add">
<i class="fas fa-save"></i> Simpan
</button>

<a href="kelola_bobot.php" class="btn-dashboard">
⬅ Kembali
</a>

</form>

</div>

</body>
</html>
