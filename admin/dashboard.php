<?php
include "cek_session.php";
?>
<link rel="stylesheet" href="../assets/css/style.css">
<!-- NAVBAR ATAS -->
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

<!-- DESKRIPSI TENGAH -->
<div class="center-content">
    <h2>Sistem Pendukung Keputusan (SPK)</h2>
    <h3>Rekomendasi Pola Makan Sehat</h3>
    <p>
        Sistem ini merupakan sistem pendukung keputusan yang digunakan untuk
        memberikan rekomendasi pola makan sehat kepada masyarakat berdasarkan
        kriteria kesehatan seperti status gizi, aktivitas fisik, dan riwayat penyakit,
        menggunakan metode <b>Simple Additive Weighting (SAW)</b>.
    </p>
    <div class="dashboard-buttons">
        <a href="masyarakat.php" class="btn-dashboard">📋 Kelola Data Masyarakat</a>
        <a href="kelola_bobot.php" class="btn-dashboard">⚖️ Kelola Data Kriteria</a>
        <a href="kelola_kriteria.php" class="btn-dashboard">⚙️ Kelola Data Sub-Kriteria</a>

    </div>
</div>
