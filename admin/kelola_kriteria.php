<?php
include "cek_session.php";
include "../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kriteria Penilaian</title>

    <!-- CSS DITAMBAHKAN DI SINI -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="container">

<center><h2>Kelola Kriteria Penilaian</h2></center>

<?php
$q = mysqli_query($koneksi, "SELECT * FROM kriteria");
while ($k = mysqli_fetch_assoc($q)) {
    echo "
        <center><h3>{$k['kode_kriteria']} - {$k['nama_kriteria']}</h3></center>
        <center><a href='tambah_sub.php?id={$k['id_kriteria']}' class='btn-add'>
            ➕ Tambah Sub Kriteria
        </a></center>
        ";
    echo "<table>
            <tr>
                <th>Sub Kriteria</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>";

    $qs = mysqli_query($koneksi, "
        SELECT * FROM sub_kriteria 
        WHERE id_kriteria = '{$k['id_kriteria']}'
    ");

    while ($s = mysqli_fetch_assoc($qs)) {
        echo "<tr>
    <td>{$s['nama_sub']}</td>
    <td>{$s['nilai']}</td>
    <td class='aksi'>
        <a href='edit_sub.php?id={$s['id_sub']}' class='btn-edit'>
            <i class='fas fa-pen'></i>Edit
        </a>
        <a href='hapus_sub.php?id={$s['id_sub']}'
            class='btn-hapus'
            onclick=\"return confirm('Yakin ingin menghapus sub kriteria ini?')\">
            <i class='fas fa-trash'></i>Hapus
        </a>
    </td>
</tr>";

    }
    echo "</table><br>";
}
?>

<a href="dashboard.php" class="btn-dashboard">⬅ Kembali ke Dashboard</a>

</div>

</body>
</html>