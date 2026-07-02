<?php
include "cek_session_user.php";
include "../config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Perhitungan SAW</title>
    <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>

<div class="user-wrapper">

    <header class="user-header">
        <h2>Hasil Perhitungan Rekomendasi</h2>
        <p>Metode Simple Additive Weighting (SAW)</p>
    </header>

    <div class="user-content">

        <table class="user-table">
            <thead>
                <tr>
                    <th>Rangking</th>
                    <th>Nama</th>
                    <th>Nilai Preferensi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "
                SELECT h.nilai_preferensi, m.nama
                FROM hasil h
                JOIN masyarakat m ON h.id_masyarakat = m.id_masyarakat
                ORDER BY h.nilai_preferensi DESC
            ");

            while ($d = mysqli_fetch_assoc($query)) {

                // KETERANGAN SAMA SEPERTI ADMIN
                if ($no == 1) {
                    $ket = "Prioritas utama rekomendasi pola makan sehat";
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
                    <td>{$d['nama']}</td>
                    <td>" . number_format($d['nilai_preferensi'], 2) . "</td>
                    <td>$ket</td>
                </tr>";

                $no++;
            }
            ?>

            </tbody>
        </table>

        <div class="user-action">
            <a href="cetak_pdf.php" class="btn-user">🖨 Cetak PDF</a>
            <a href="dashboard.php" class="btn-user secondary">⬅ Kembali</a>
        </div>

    </div>

</div>

</body>
</html>