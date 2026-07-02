<?php
include "cek_session.php";
include "../config/koneksi.php";

$id_kriteria = $_GET['id'];

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_sub'];
    $nilai = $_POST['nilai'];

    mysqli_query($koneksi, "
        INSERT INTO sub_kriteria (id_kriteria, nama_sub, nilai)
        VALUES ('$id_kriteria', '$nama', '$nilai')
    ");

    header("Location: kelola_kriteria.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Sub Kriteria</title>
    <link rel="stylesheet" href="../assets/css/masyarakat_edit.css">
</head>
<body>

<div class="edit-container">
    <h2>Tambah Sub Kriteria</h2>

    <form method="post">
        <div class="form-group">
            <label>Nama Sub Kriteria</label>
            <input type="text" name="nama_sub" required>
        </div>

        <div class="form-group">
            <label>Nilai</label>
            <input type="number" name="nilai" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-update">Simpan</button>
        <a href="kelola_kriteria.php" class="btn-back">Kembali</a>
    </form>
</div>

</body>
</html>