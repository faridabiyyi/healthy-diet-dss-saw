<?php
include "cek_session.php";
include "../config/koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$id'")
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kriteria</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="form-container">
    <h2>Edit Kriteria</h2>

    <form method="post">
        <label>Nama Kriteria</label>
        <input type="text" name="nama" value="<?= $data['nama_kriteria']; ?>" required>

        <label>Bobot</label>
        <input type="number" step="0.01" name="bobot" value="<?= $data['bobot']; ?>" required>

        <div class="form-actions">
            <button type="submit" name="update" class="btn-simpan">Update</button>
            <a href="bobot.php" class="btn-kembali">← Kembali</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $bobot = $_POST['bobot'];

    mysqli_query($koneksi, "
        UPDATE kriteria 
        SET nama_kriteria='$nama', bobot='$bobot'
        WHERE id_kriteria='$id'
    ");

    header("location:bobot.php");
}
?>

</body>
</html>
