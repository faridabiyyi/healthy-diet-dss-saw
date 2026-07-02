<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

<div class="page-wrapper">

    <div class="container">
        <!-- LOGO KIRI -->
        <div class="logo-area">
            <img src="assets/img/logo1.png" alt="Logo 1">
            <img src="assets/img/logo2.png" alt="Logo 2">
        </div>

        <!-- FORM KANAN -->
        <div class="login-area">
            <h2>SPK<br>Rekomendasi Pola Makan Sehat<br>Login Admin</h2>
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

            <form method="post" action="proses_login.php">
                <label>Username</label>
                <input type="text" name="username" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <div class="login-action">
                    <button type="submit">Login</button>
                    <a href="login_user.php" class="link-user">Login sebagai User</a>
                </div>

            </form>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="login-footer">
        <span>© 2026 SPK Rekomendasi Pola Makan Sehat – Farid Abiyyi</span>

        <div class="footer-right">
            <a href="https://wa.me/6281364064927" target="_blank" class="social wa">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="https://instagram.com/faridabiyyi" target="_blank" class="social ig">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </footer>

</div>

</body>
</html>
