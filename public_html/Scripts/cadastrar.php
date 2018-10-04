<?php
    $vet = $_POST;
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user , $db_password) or die ("Sem conexão com o servidor: " . mysqli_error($con));
    $select = mysqli_select_db($con, $db_name) or die("Sem conexão com o banco de dados: " . mysqli_error($con));

    $usuario = $_POST['usr'];
    $senha = $_POST['pas1'];
    $repetesenha = $_POST['pas2'];
    $nome = $_POST['nome'];
    $cat = $_POST['cat'];

    if(empty($usuario) or empty($senha) or empty($repetesenha) or ($senha != $repetesenha)){
        header('location:../cadastro.php?falta=true');
        exit();
    }

    $chave = md5("4376757d394d5e6f7941235c294b29257366333a5d472f517e793a7c3b");
    $senhacrip = openssl_encrypt($senha, "AES-256-CBC", $chave);
    $senhacod = base64_encode($senhacrip);

    mysqli_query($con, "insert into Usuario (nome, usuario, senha, codCat) values ('$nome', '$usuario', '$senhacod', $cat)") or die("Erro: " . mysqli_error($con));
    header('location:../index.php');
?>
