<?php
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

<h2>Hasil Perangkingan Metode SAW</h2>
<a href="cetak_hasil.php" target="_blank" class="btn-dashboard">
    🖨 Cetak Laporan PDF
</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Kode Alternatif</th>
    <th>Nama</th>
    <th>Nilai Preferensi</th>
    <th>Rangking</th>
    <th>Keterangan</th>
</tr>

<?php
$no = 1;
$q = mysqli_query($koneksi, "
    SELECT h.nilai_preferensi, m.nama, m.id_masyarakat
    FROM hasil h
    JOIN masyarakat m ON h.id_masyarakat = m.id_masyarakat
    ORDER BY h.nilai_preferensi DESC
");

while ($d = mysqli_fetch_assoc($q)) {

    if ($no == 1) {
        $ket = "<b>Prioritas utama rekomendasi pola makan sehat</b>";
    } elseif ($no <= 3) {
        $ket = "Prioritas tinggi rekomendasi pola makan sehat";
    } elseif ($no <= 12) {
        $ket = "Perlu pengaturan pola makan dan pemantauan";
    } elseif ($no <= 17) {
        $ket = "Edukasi pola makan sehat dan pemantauan ringan";
    } else {
        $ket = "Edukasi umum pola makan sehat";
    }

    echo "<tr>
        <td>$no</td>
        <td>A{$d['id_masyarakat']}</td>
        <td>{$d['nama']}</td>
        <td>" . number_format($d['nilai_preferensi'], 2) . "</td>
        <td>$no</td>
        <td>$ket</td>
    </tr>";

    $no++;
}
?>
</table>
