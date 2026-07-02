<?php
include "cek_session.php";
include "../config/koneksi.php";
?>

<h2>Input Penilaian SAW</h2>

<form method="post">
    Nama Masyarakat:<br>
    <select name="id_masyarakat" required>
        <option value="">-- Pilih --</option>
        <?php
        $m = mysqli_query($koneksi, "SELECT * FROM masyarakat");
        while ($r = mysqli_fetch_assoc($m)) {
            echo "<option value='$r[id_masyarakat]'>$r[nama]</option>";
        }
        ?>
    </select><br><br>

    Status Gizi (C1):<br>
    <select name="c1">
        <option value="5">Normal</option>
        <option value="3">Kelebihan BB</option>
        <option value="1">Obesitas</option>
        <option value="2">Kurus</option>
    </select><br><br>

    Riwayat Penyakit (C2):<br>
    <select name="c2">
        <option value="5">Tidak Ada</option>
        <option value="3">Hipertensi</option>
        <option value="2">Diabetes Melitus</option>
        <option value="1">Asma</option>
    </select><br><br>

    Aktivitas Fisik (C3):<br>
    <select name="c3">
        <option value="1">Ringan</option>
        <option value="3">Sedang</option>
        <option value="5">Berat</option>
    </select><br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="penilaian.php">Kembali</a>
</form>

<?php
if (isset($_POST['simpan'])) {
    $id = $_POST['id_masyarakat'];
    $c1 = $_POST['c1'];
    $c2 = $_POST['c2'];
    $c3 = $_POST['c3'];

    mysqli_query($koneksi, "
        INSERT INTO penilaian (id_masyarakat, c1, c2, c3)
        VALUES ('$id','$c1','$c2','$c3')
    ");

    header("location:penilaian.php");
}
?>
