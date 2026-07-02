<?php
include "cek_session.php";
include "../config/koneksi.php";
?>
<link rel="stylesheet" href="../assets/css/style.css">

<div class="form-container">
    <h2>Tambah Data Masyarakat</h2>

    <form method="post">
        <label>Nama</label>
        <input type="text" name="nama" required>

        <label>Berat Badan (kg)</label>
        <input type="number" name="bb" required>

        <label>Tinggi Badan (cm)</label>
        <input type="number" name="tb" required>

        <label>Riwayat Penyakit</label>
        <select name="penyakit">
            <option value="Tidak Ada">Tidak Ada</option>
            <option value="HT">Hipertensi</option>
            <option value="DM">Diabetes Melitus</option>
        </select>

        <label>Aktivitas Fisik</label>
        <select name="aktivitas">
            <option value="Ringan">Ringan</option>
            <option value="Sedang">Sedang</option>
            <option value="Berat">Berat</option>
        </select>

        <div class="form-actions">
            <button type="submit" name="simpan" class="btn-simpan">Simpan</button>
            <a href="masyarakat.php" class="btn-kembali">← Kembali</a>
        </div>
    </form>
</div>


<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $bb   = $_POST['bb'];
    $tb   = $_POST['tb'];
    $penyakit = $_POST['penyakit'];
    $aktivitas = $_POST['aktivitas'];

    // Hitung IMT
    $imt = $bb / (($tb/100) * ($tb/100));

    // Status gizi
    if ($imt < 18.5) {
        $status = "Kurus";
    } elseif ($imt <= 22.9) {
        $status = "Normal";
    } elseif ($imt <= 24.9) {
        $status = "Kelebihan Berat Badan";
    } else {
        $status = "Obesitas";
    }

    mysqli_query($koneksi, "
        INSERT INTO masyarakat 
        (nama, berat_badan, tinggi_badan, imt, status_gizi, riwayat_penyakit, aktivitas_fisik)
        VALUES
        ('$nama','$bb','$tb','$imt','$status','$penyakit','$aktivitas')
    ");

    header("location:masyarakat.php");
}
?>
