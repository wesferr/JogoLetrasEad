<?php
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user , $db_password) or die ("Sem conexão com o servidor: " . mysqli_error($con));
    $select = mysqli_select_db($con, $db_name) or die("Sem conexão com o banco de dados: " . mysqli_error($con));
    
    $cod = $_POST['cod'];
    mysqli_query($con, "delete from Resposta where Resposta.pergunta = $cod") or die("Erro: " . mysqli_error($con));
    mysqli_query($con, "delete from Pergunta where Pergunta.cod = $cod") or die("Erro: " . mysqli_error($con));
?>
