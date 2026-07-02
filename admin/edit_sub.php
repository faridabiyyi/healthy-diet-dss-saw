<?php
include "cek_session.php";
include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT s.*, k.kode_kriteria, k.nama_kriteria
    FROM sub_kriteria s
    JOIN kriteria k ON s.id_kriteria = k.id_kriteria
    WHERE s.id_sub = '$id'
"));

if (isset($_POST['simpan'])) {

    mysqli_query($koneksi, "
        UPDATE sub_kriteria SET
        nama_sub = '{$_POST['nama_sub']}',
        nilai = '{$_POST['nilai']}'
        WHERE id_sub = '$id'
    ");

    header("Location: kelola_kriteria.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Sub Kriteria</title>

    <!-- CSS WAJIB -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">

    <div class="card">

        <h2 class="page-title">Edit Sub Kriteria</h2>

        <p class="subtitle">
            <b><?= $data['kode_kriteria']; ?> - <?= $data['nama_kriteria']; ?></b>
        </p>

        <form method="post" class="form-box">

            <div class="form-group">
                <label>Nama Sub Kriteria</label>
                <input type="text" name="nama_sub"
                       value="<?= $data['nama_sub']; ?>" required>
            </div>

            <div class="form-group">
                <label>Nilai</label>
                <input type="number" name="nilai"
                       value="<?= $data['nilai']; ?>" required>
            </div>

            <div class="form-action">
                <button type="submit" name="simpan" class="btn-dashboard">
                    💾 Simpan
                </button>

                <a href="kelola_kriteria.php" class="btn-dashboard btn-secondary">
                    ⬅ Kembali
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>
