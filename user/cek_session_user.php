<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location: ../login_user.php");
    exit;
}