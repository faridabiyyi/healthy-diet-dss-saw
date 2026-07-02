<?php
include "cek_session.php";
include "../config/koneksi.php";

$id = $_GET['id'];

// ==========================
// PROSES UPDATE (DI ATAS)
// ==========================
if (isset($_POST['update'])) {

    $nama = $_POST['nama'];
    $bb   = $_POST['bb'];
    $tb   = $_POST['tb'];

    $imt = $bb / (($tb / 100) * ($tb / 100));

    if ($imt < 18.5) {
        $status = "Kurus";
    } elseif ($imt <= 22.9) {
        $status = "Normal";
    } elseif ($imt <= 24.9) {
        $status = "Kelebihan Berat Badan";
    } else {
        $status = "Obesitas";
    }

    $update = mysqli_query($koneksi, "
        UPDATE masyarakat SET
            nama='$nama',
            berat_badan='$bb',
            tinggi_badan='$tb',
            imt='$imt',
            status_gizi='$status'
        WHERE id_masyarakat='$id'
    ");

    if ($update) {
        header("Location: masyarakat.php");
        exit;
    } else {
        echo "Gagal update data: " . mysqli_error($koneksi);
        exit;
    }
}

// ==========================
// AMBIL DATA
// ==========================
$data = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE id_masyarakat='$id'")
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Masyarakat</title>
    <link rel="stylesheet" href="../assets/css/masyarakat_edit.css">
</head>

<body>

<div class="edit-container">
    <h2>Edit Data Masyarakat</h2>

    <form method="post" action="">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $data['nama'] ?>" required>
        </div>

        <div class="form-group">
            <label>Berat Badan (kg)</label>
            <input type="number" name="bb" value="<?= $data['berat_badan'] ?>" required>
        </div>

        <div class="form-group">
            <label>Tinggi Badan (cm)</label>
            <input type="number" name="tb" value="<?= $data['tinggi_badan'] ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-update">Update</button>
        <a href="masyarakat.php" class="btn-back">Kembali</a>
    </form>
</div>

</body>
</html>