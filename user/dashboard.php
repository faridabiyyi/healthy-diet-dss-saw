<?php include "cek_session_user.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>

<div class="user-wrapper">

    <header class="user-header">
        <h2>Dashboard User</h2>
        <p>Selamat datang, <b><?= $_SESSION['nama_user']; ?></b></p>
    </header>

    <div class="user-menu">

        <a href="hasil.php" class="user-card">
            <span class="icon">📊</span>
            <h3>Lihat Hasil Perhitungan</h3>
            <p>Melihat hasil perangkingan rekomendasi pola makan sehat</p>
        </a>
    </div>

    <div class="user-logout">
        <a href="../logout.php">Logout</a>
    </div>

</div>

</body>
</html>
