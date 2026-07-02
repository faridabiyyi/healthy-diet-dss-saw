<?php
include "cek_session.php";
include "../config/koneksi.php";

/* =========================
   RESET PENILAIAN
   ========================= */
mysqli_query($koneksi, "TRUNCATE TABLE penilaian");

/* =========================
   AMBIL DATA MASYARAKAT
   ========================= */
$q = mysqli_query($koneksi, "SELECT * FROM masyarakat");

while ($m = mysqli_fetch_assoc($q)) {

    // C1 - Status Gizi
    $q1 = mysqli_fetch_assoc(mysqli_query($koneksi, "
        SELECT nilai FROM sub_kriteria
        WHERE LOWER(nama_sub) = LOWER('{$m['status_gizi']}')
    "));
    $c1 = $q1['nilai'] ?? 0;

    // C2 - Riwayat Penyakit
    $q2 = mysqli_fetch_assoc(mysqli_query($koneksi, "
        SELECT nilai FROM sub_kriteria
        WHERE LOWER(nama_sub) = LOWER('{$m['riwayat_penyakit']}')
    "));
    $c2 = $q2['nilai'] ?? 0;

    // C3 - Aktivitas Fisik
    $q3 = mysqli_fetch_assoc(mysqli_query($koneksi, "
        SELECT nilai FROM sub_kriteria
        WHERE LOWER(nama_sub) = LOWER('{$m['aktivitas_fisik']}')
    "));
    $c3 = $q3['nilai'] ?? 0;

    // Simpan
    mysqli_query($koneksi, "
        INSERT INTO penilaian (id_masyarakat, c1, c2, c3)
        VALUES ('{$m['id_masyarakat']}', '$c1', '$c2', '$c3')
    ");
}

/* =========================
   REDIRECT OTOMATIS
   ========================= */
header("Location: ../admin/penilaian.php?status=generated");
exit;