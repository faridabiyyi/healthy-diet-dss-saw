<?php
include "cek_session.php";
include "../config/koneksi.php";

/* =========================
   PROSES UPLOAD CSV
========================= */
if (isset($_POST['upload_csv'])) {
    $file = $_FILES['file_csv']['tmp_name'];

    if (!empty($file)) {
        $handle = fopen($file, "r");

        // Lewati header CSV
        fgetcsv($handle);

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            $nama             = mysqli_real_escape_string($koneksi, $data[0]);
            $berat_badan      = $data[1];
            $tinggi_badan     = $data[2];
            $imt              = $data[3];
            $status_gizi      = $data[4];
            $riwayat_penyakit = $data[5];
            $aktivitas_fisik  = $data[6];

            mysqli_query($koneksi, "
                INSERT INTO masyarakat
                (nama, berat_badan, tinggi_badan, imt, status_gizi, riwayat_penyakit, aktivitas_fisik)
                VALUES
                ('$nama','$berat_badan','$tinggi_badan','$imt','$status_gizi','$riwayat_penyakit','$aktivitas_fisik')
            ");
        }

        fclose($handle);
        echo "<script>alert('Data CSV berhasil diimport'); window.location='masyarakat.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Data Masyarakat</title>
</head>
<body>


<nav class="navbar">
    <div class="nav-left">
        <span class="brand">SPK Rekomendasi Pola Makan Sehat</span>
    </div>

    <ul class="nav-menu">
         <li><a href="dashboard.php">Halaman Utama</a></li>
        <li><a href="masyarakat.php">Data Masyarakat</a></li>
        <li><a href="penilaian.php">Data Penilaian</a></li>
        <li><a href="../proses/saw_proses.php">Proses SAW</a></li>
        <li><a href="saw_hasil.php">Hasil Perangkingan</a></li>
        <li><a href="../logout.php" class="logout">Logout</a></li>
    </ul>
</nav>


<br><br>

<!-- FORM UPLOAD CSV -->
<div class="form-upload">
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file_csv" accept=".csv" required><br>
        <button type="submit" name="upload_csv">Upload CSV</button>
        <a href="masyarakat_tambah.php">
        <button type="button" class="btn-add">+ Tambah Data</button>
    </a>
    </form>
</div>
<!-- TOMBOL NAVIGASI -->
<br>
<center><h2>Data Masyarakat</h2></center>
<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>BB</th>
    <th>TB</th>
    <th>IMT</th>
    <th>Status Gizi</th>
    <th>Riwayat Penyakit</th>
    <th>Aktivitas Fisik</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM masyarakat");

while ($data = mysqli_fetch_assoc($query)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $data['nama']; ?></td>
    <td><?= $data['berat_badan']; ?></td>
    <td><?= $data['tinggi_badan']; ?></td>
    <td><?= $data['imt']; ?></td>
    <td><?= $data['status_gizi']; ?></td>
    <td><?= $data['riwayat_penyakit']; ?></td>
    <td><?= $data['aktivitas_fisik']; ?></td>
    <td>
        <a href="masyarakat_edit.php?id=<?= $data['id_masyarakat']; ?>">Edit</a> |
        <a href="masyarakat_hapus.php?id=<?= $data['id_masyarakat']; ?>"
           onclick="return confirm('Yakin hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
