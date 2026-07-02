<?php
include "cek_session.php";
include "../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Kelola Data Kriteria</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
<body>
    <br><br>
    <div class="container">

    <center><h2>Data Kriteria</h2>
    <a href="tambah_kriteria.php" class="btn-add">
        <i class="fas fa-plus"></i> Tambah Kriteria
    </a>
    </center>
    <table>
        <tr>
            <th>Kode</th>
            <th>Nama Kriteria</th>
            <th>Tipe</th>
            <th>Bobot</th>
            <th>Aksi</th>
        </tr>
<?php
$q = mysqli_query($koneksi, "SELECT * FROM kriteria");
while ($k = mysqli_fetch_assoc($q)) {
    echo "<tr>
        <td>{$k['kode_kriteria']}</td>
        <td>{$k['nama_kriteria']}</td>
        <td>{$k['tipe']}</td>
        <td>{$k['bobot']}</td>
        <td class='aksi'>

            <a href='edit_bobot.php?id=".$k['id_kriteria']."'
               class='btn-edit'>
                <i class='fas fa-pen'></i> Edit
            </a>

            <a href='hapus_kriteria.php?id=".$k['id_kriteria']."'
               class='btn-hapus'
               onclick=\"return confirm('Yakin ingin menghapus kriteria ini?')\">
                <i class='fas fa-trash'></i> Hapus
            </a>

        </td>
    </tr>";
}
?>
</table>
<a href="dashboard.php" class="btn-dashboard">⬅ Kembali ke Dashboard</a>

</div>

</body>
</html>