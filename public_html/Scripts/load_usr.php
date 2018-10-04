<?php
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user , $db_password) or die ("Sem conexão com o servidor: " . mysqli_error($con));
    $select = mysqli_select_db($con, $db_name) or die("Sem conexão com o banco de dados: " . mysqli_error($con));
    
    $login = $_SESSION['login'];
    $senha = $_SESSION['senha'];
    
    $chave = md5("4376757d394d5e6f7941235c294b29257366333a5d472f517e793a7c3b");
    $senhacod = base64_decode($senha);
    $senhacrip = openssl_encrypt($senha, "AES-256-CBC", $chave);
    $req = mysqli_query($con, "select nome from Usuario where usuario='$login' and senha='$senha'") or die("Erro: " . mysqli_error($con));
    $nome = mysqli_fetch_row($req)[0];
    echo("$('#login_box').val('$login');");
    echo("$('#nome_box').val('$nome');");
    mysqli_close();
    
?>
