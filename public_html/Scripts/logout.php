<?php
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    unset($_SESSION['cat']);
    header('location:../index.php');
?>
