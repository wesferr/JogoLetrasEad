<?php
    session_start();
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user , $db_password) or die ("Sem conexão com o servidor: " . mysqli_error($con));
    $select = mysqli_select_db($con, $db_name) or die("Sem conexão com o banco de dados: " . mysqli_error($con));
    
    $login = $_SESSION['login'];
    $senha = $_SESSION['senha'];
    
    $req = mysqli_query($con, "select pontos from Usuario where usuario='$login' and senha='$senha'") or die("Erro: " . mysqli_error($con));
    $pontos = mysqli_fetch_row($req)[0];
    echo(json_encode($pontos));
?>
