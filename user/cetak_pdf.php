<?php
include "cek_session_user.php";
include "../config/koneksi.php";
require_once "../dompdf/autoload.inc.php";

use Dompdf\Dompdf;

// ===============================
// AMBIL DATA HASIL PERANGKINGAN
// ===============================
$query = mysqli_query($koneksi, "
    SELECT h.nilai_preferensi, m.nama
    FROM hasil h
    JOIN masyarakat m ON h.id_masyarakat = m.id_masyarakat
    ORDER BY h.nilai_preferensi DESC
");

// ===============================
// HTML UNTUK PDF
// ===============================
function imageToBase64($path) {
    if (!file_exists($path)) {
        return '';
    }
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    return 'data:image/' . $type . ';base64,' . base64_encode($data);
}

$logo2 = imageToBase64(__DIR__ . '/../assets/img/logo2.png');
$logo1 = imageToBase64(__DIR__ . '/../assets/img/logo1.png');
$html = '
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    .header h2 {
        margin: 0;
    }
    .header p {
        margin: 3px 0;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    th {
        background: #2e7d32;
        color: #fff;
        padding: 8px;
        border: 1px solid #000;
    }
    td {
        padding: 8px;
        border: 1px solid #000;
        text-align: center;
    }
    .footer {
    margin-top: 30px;
    width: 100%;
    }

    .footer td {
    border: none;
    font-size: 12px;
    }

    .footer-right {
    width: 40%;
    text-align: center;
    }
        .header-table {
        width: 100%;
        border-bottom: 2px solid #000;
        margin-bottom: 15px;
    }  

    .header-table td {
        border: none;
        vertical-align: middle;
    }

    .logo {
        width: 70px;
        height: auto;
    }
    .header-text {
    text-align: center;
    }
</style>

<table class="header-table">
    <tr>
        <td width="15%" align="left">
            <img src="'.$logo2.'" class="logo">
        </td>
        <td width="70%" class="header-text">
            <h2>DINAS KESEHATAN KOTA SOLOK</h2>
            <p>Sistem Pendukung Keputusan</p>
            <p><b>Rekomendasi Pola Makan Sehat</b></p>
        </td>
        <td width="15%" align="right">
            <img src="'.$logo1.'" class="logo">
        </td>
    </tr>
</table>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nilai Preferensi</th>
        <th>Keterangan</th>
    </tr>
';

$no = 1;
while ($d = mysqli_fetch_assoc($query)) {

    // KETERANGAN SAMA DENGAN ADMIN
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

    $html .= "
        <tr>
            <td>$no</td>
            <td>{$d['nama']}</td>
            <td>" . number_format($d['nilai_preferensi'], 2) . "</td>
            <td>$ket</td>
        </tr>
    ";

    $no++;
}

$html .= '
</table>
<table class="footer">
    <tr>
        <td width="60%"></td>
        <td class="footer-right">
            <p>Solok, '.date('d F Y').'</p>
            <br><br><br><br>
            <p>(...........................................)</p>
            <p><b>Petugas Dinas Kesehatan</b></p>
        </td>
    </tr>
</table>
';

// ===============================
// PROSES CETAK PDF
// ===============================
$dompdf = new Dompdf();
$dompdf->setPaper('A4', 'portrait');
$dompdf->set_option('chroot', realpath(__DIR__ . "/.."));
$dompdf->loadHtml($html);
$dompdf->render();

// false = tampil di browser (tidak download otomatis)
$dompdf->stream("Hasil_Rekomendasi_Pola_Makan_Sehat.pdf", ["Attachment" => false]);