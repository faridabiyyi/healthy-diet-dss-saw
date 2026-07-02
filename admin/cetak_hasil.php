<?php
require_once "../dompdf/autoload.inc.php";
use Dompdf\Dompdf;

include "../config/koneksi.php";

// Ambil data hasil ranking
$q = mysqli_query($koneksi, "
    SELECT h.nilai_preferensi, m.nama
    FROM hasil h
    JOIN masyarakat m ON h.id_masyarakat = m.id_masyarakat
    ORDER BY h.nilai_preferensi DESC
");

// HTML untuk PDF
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
    body { font-family: Arial, sans-serif; }
    h2 { text-align: center; }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #000;
        padding: 6px;
        font-size: 12px;
        text-align: center;
    }
    th {
        background-color: #e0f2f1;
    }
    .logo {
        width: 70px;
        height: auto;
    }
    .header-text {
    text-align: center;
    }
    .footer {
    margin-top: 40px;
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
    <th>Rangking</th>
    <th>Keterangan</th>
</tr>
';

$no = 1;
while ($d = mysqli_fetch_assoc($q)) {

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
        <td>$no</td>
        <td>$ket</td>
    </tr>";

    $no++;
}

$html .= '</table>
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

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output
$dompdf->stream("Laporan_Hasil_Perangkingan.pdf", ["Attachment" => false]);