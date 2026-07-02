<?php
session_start();
include "config/koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "
    SELECT * FROM user 
    WHERE username='$username' AND password='$password'
");

if (mysqli_num_rows($query) > 0) {
    $u = mysqli_fetch_assoc($query);

    // SET SESSION USER
    $_SESSION['login_user'] = true;
    $_SESSION['id_user']    = $u['id_user'];
    $_SESSION['nama_user']  = $u['nama'];

    // ARAHKAN KE DASHBOARD USER
    header("Location: user/dashboard.php");
    exit;

} else {
    $_SESSION['error'] = "Username atau password salah!";
    header("Location: login_user.php");
}
