<?php
session_start();
include "config/koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "
    SELECT * FROM login 
    WHERE username='$username' 
    AND password='$password'
");

$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    
    $_SESSION['login'] = true;
    $_SESSION['id_login'] = $data['id_login'];
    $_SESSION['username'] = $data['username'];

    header("location:admin/dashboard.php");
} else {
    $_SESSION['error'] = "Username atau password salah!";
    header("Location: index.php");
}
?>