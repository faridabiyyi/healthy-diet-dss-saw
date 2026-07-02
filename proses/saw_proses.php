 <link rel="stylesheet" href="../assets/css/style.css">
<?php
echo "<div class='saw-container'>";
include "../config/koneksi.php";
echo "
<div class='saw-action'>
    <a href='../admin/dashboard.php' class='btn-back-dashboard'>⬅ Kembali ke Dashboard</a>

</div>
";
/* =========================
   AMBIL BOBOT KRITERIA
   ========================= */
$bobot = [];
$qb = mysqli_query($koneksi, "SELECT kode_kriteria, bobot FROM kriteria");
while ($k = mysqli_fetch_assoc($qb)) {
    $bobot[$k['kode_kriteria']] = $k['bobot'];
}

/* =========================
   NILAI MAKSIMUM
   ========================= */
$max = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT 
        MAX(c1) AS max_c1,
        MAX(c2) AS max_c2,
        MAX(c3) AS max_c3
    FROM penilaian
"));

/* =========================
   KOSONGKAN TABEL HASIL
   ========================= */
mysqli_query($koneksi, "TRUNCATE TABLE hasil");

/* =========================
   AMBIL DATA PENILAIAN
   ========================= */
$data = mysqli_query($koneksi, "
    SELECT p.*, m.nama 
    FROM penilaian p 
    JOIN masyarakat m ON p.id_masyarakat = m.id_masyarakat
");

/* =========================
   TABEL MATRKS KEPUTUSAN (X)
   ========================= */
echo "<h3>Matriks Keputusan (X)</h3>";
echo "<table border='1' cellpadding='8'>
<tr>
    <th>Alternatif</th>
    <th>Nama</th>
    <th>C1</th>
    <th>C2</th>
    <th>C3</th>
</tr>";

$rows = [];
while ($d = mysqli_fetch_assoc($data)) {
    echo "<tr>
        <td>A{$d['id_masyarakat']}</td>
        <td>{$d['nama']}</td>
        <td>{$d['c1']}</td>
        <td>{$d['c2']}</td>
        <td>{$d['c3']}</td>
    </tr>";
    $rows[] = $d;
}
echo "</table>";

/* =========================
   TABEL NORMALISASI (R)
   ========================= */
  

echo "<h3>Matriks Normalisasi (R)</h3>";
echo "<table border='1' cellpadding='8'>
<tr>
    <th>Alternatif</th>
    <th>R1</th>
    <th>R2</th>
    <th>R3</th>
</tr>";

foreach ($rows as $d) {
    $r1 = $d['c1'] / $max['max_c1'];
    $r2 = $d['c2'] / $max['max_c2'];
    $r3 = $d['c3'] / $max['max_c3'];

    echo "<tr>
        <td>A{$d['id_masyarakat']}</td>
        <td>" . number_format($r1, 2) . "</td>
        <td>" . number_format($r2, 2) . "</td>
        <td>" . number_format($r3, 2) . "</td>
    </tr>";
}
echo "</table>";

/* =========================
   TABEL NILAI PREFERENSI (V)
   ========================= */
echo "<h3>Nilai Preferensi (V)</h3>";
echo "<table border='1' cellpadding='8'>
<tr>
    <th>Alternatif</th>
    <th>Nama</th>
    <th>Nilai Preferensi</th>
</tr>";

foreach ($rows as $d) {
    $r1 = $d['c1'] / $max['max_c1'];
    $r2 = $d['c2'] / $max['max_c2'];
    $r3 = $d['c3'] / $max['max_c3'];

    $V =
        ($r1 * $bobot['C1']) +
        ($r2 * $bobot['C2']) +
        ($r3 * $bobot['C3']);

    // simpan ke database
    mysqli_query($koneksi, "
        INSERT INTO hasil (id_masyarakat, nilai_preferensi)
        VALUES ('{$d['id_masyarakat']}', ROUND($V, 4))
    ");

    echo "<tr>
        <td>A{$d['id_masyarakat']}</td>
        <td>{$d['nama']}</td>
        <td>" . number_format($V, 2) . "</td>
    </tr>";
}
echo "</table>";

echo "<br><b>✔ Proses SAW selesai dan data berhasil disimpan.</b>";
?>

