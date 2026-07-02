<?php
include "cek_session.php";
include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT * FROM kriteria
    WHERE id_kriteria='$id'
"));

if(isset($_POST['update'])){

    $nama  = mysqli_real_escape_string($koneksi,$_POST['nama']);
    $tipe  = mysqli_real_escape_string($koneksi,$_POST['tipe']);
    $bobot = mysqli_real_escape_string($koneksi,$_POST['bobot']);

    mysqli_query($koneksi,"
        UPDATE kriteria SET
        nama_kriteria='$nama',
        tipe='$tipe',
        bobot='$bobot'
        WHERE id_kriteria='$id'
    ");

    echo "<script>
        alert('Kriteria berhasil diperbarui!');
        window.location='kelola_bobot.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Kriteria</title>

<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<div class="container">

<div class="form-card">

<center>
<h2>Edit Kriteria</h2>
<h3><?= $data['kode_kriteria']; ?></h3>
</center>

<form method="POST">

<label>Nama Kriteria</label>
<input type="text"
       name="nama"
       value="<?= $data['nama_kriteria']; ?>"
       required>

<label>Tipe Kriteria</label>
<select name="tipe" required>

<option value="benefit"
<?= ($data['tipe']=='benefit') ? 'selected' : ''; ?>>
Benefit
</option>

<option value="cost"
<?= ($data['tipe']=='cost') ? 'selected' : ''; ?>>
Cost
</option>

</select>

<label>Bobot (0 - 1)</label>
<input type="number"
       step="0.01"
       name="bobot"
       value="<?= $data['bobot']; ?>"
       required>

<br>

<button class="btn-add" name="update">
<i class="fas fa-save"></i> Simpan
</button>

<a href="kelola_bobot.php" class="btn-dashboard">
⬅ Kembali
</a>

</form>

</div>
</div>

</body>
</html>
