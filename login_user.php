<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="page-wrapper">
    <div class="container">

        <div class="logo-area">
            <img src="assets/img/logo1.png">
            <img src="assets/img/logo2.png">
        </div>

        <div class="login-area">
            <h2>SPK<br>Rekomendasi Pola Makan Sehat<br>Login User</h2>
            <?php
                session_start();
            ?>

            <!-- PESAN ERROR LOGIN -->
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="login-error">
                    <?= $_SESSION['error']; ?>
                </div>
            <?php 
            unset($_SESSION['error']); 
            endif; 
        ?>

            <form method="post" action="proses_login_user.php">
                <label>Username</label>
                <input type="text" name="username" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <button type="submit">Login User</button>
            </form>

            <a href="index.php" class="link-user">← Kembali ke Login Admin</a>
        </div>

    </div>
    <!-- FOOTER -->
    <footer class="login-footer">
        <span>© 2026 SPK Rekomendasi Pola Makan Sehat – Farid Abiyyi</span>
    </footer>
</div>

</body>
</html>
