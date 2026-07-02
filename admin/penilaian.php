<?php
include "cek_session.php";
include "../config/koneksi.php";
?>
<link rel="stylesheet" href="../assets/css/style.css">
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

<h2>Data Penilaian Alternatif</h2>

<a href="../proses/proses_generate.php"
   onclick="return confirm('Generate ulang penilaian dari data masyarakat?')">
   🔄 Generate Penilaian Otomatis
</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>C1<br>(Status Gizi)</th>
    <th>C2<br>(Riwayat Penyakit)</th>
    <th>C3<br>(Aktivitas Fisik)</th>
</tr>

<?php
$no = 1;
$query = mysqli_query($koneksi, "
    SELECT p.*, m.nama
    FROM penilaian p
    JOIN masyarakat m ON p.id_masyarakat = m.id_masyarakat
");

while ($data = mysqli_fetch_assoc($query)) {
    echo "<tr>
        <td>$no</td>
        <td>{$data['nama']}</td>
        <td>{$data['c1']}</td>
        <td>{$data['c2']}</td>
        <td>{$data['c3']}</td>
    </tr>";
    $no++;
}
?>
</table>
