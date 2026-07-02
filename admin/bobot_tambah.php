<?php
include "cek_session.php";
include "../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kriteria</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="form-container">
    <h2>Tambah Kriteria</h2>

    <form method="post">
        <label>Kode Kriteria</label>
        <input type="text" name="kode" placeholder="C1, C2, C3..." required>

        <label>Nama Kriteria</label>
        <input type="text" name="nama" required>

        <label>Bobot</label>
        <input type="number" step="0.01" name="bobot" required>

        <label>Tipe Kriteria</label>
        <select name="tipe" required>
            <option value="">-- Pilih Tipe --</option>
            <option value="benefit">Benefit</option>
            <option value="cost">Cost</option>
        </select>

        <div class="form-actions">
            <button type="submit" name="simpan" class="btn-simpan">Simpan</button>
            <a href="bobot.php" class="btn-kembali">← Kembali</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['simpan'])) {
    $kode  = $_POST['kode'];
    $nama  = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $tipe  = $_POST['tipe'];

    mysqli_query($koneksi, "
        INSERT INTO kriteria (kode_kriteria, nama_kriteria, bobot, tipe)
        VALUES ('$kode', '$nama', '$bobot', '$tipe')
    ");

    header("location:bobot.php");
}
?>

</body>
</html>
