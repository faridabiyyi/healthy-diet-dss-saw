<?php
include "cek_session.php";
include "../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Bobot</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h2>Data Bobot</h2>
<div class="action-bar">
    <a href="dashboard.php" class="btn-back-dashboard">← Kembali ke Dashboard</a> 
    <a href="bobot_tambah.php" class="btn-add">+ Tambah Kriteria</a>
</div>
<table>
    <tr>
        <th>No</th>
        <th>Kode Kriteria</th>
        <th>Nama Kriteria</th>
        <th>Bobot</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM kriteria");

while ($k = mysqli_fetch_assoc($query)) {
?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $k['kode_kriteria']; ?></td>
        <td><?= $k['nama_kriteria']; ?></td>
        <td><?= $k['bobot']; ?></td>
        <td class="aksi">
            <a href="bobot_edit.php?id=<?= $k['id_kriteria']; ?>" class="btn-edit">Edit</a>
            <a href="bobot_hapus.php?id=<?= $k['id_kriteria']; ?>"
               class="btn-hapus"
               onclick="return confirm('Yakin ingin menghapus kriteria ini?')">
               Hapus
            </a>
        </td>
    </tr>
<?php } ?>

</table>

</body>
</html>
