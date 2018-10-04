<?php
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user , $db_password) or die ("Sem conexão com o servidor: " . mysqli_error($con));
    $select = mysqli_select_db($con, $db_name) or die ("Sem conexão com o banco de dados: " . mysqli_error($con));
    
    
    $tema = utf8_decode($_POST['cat']);

    $cards = mysqli_query($con, "SELECT nome FROM Tema");
    $vet = array();
    while($req = mysqli_fetch_row($con, $cards) ){
        $vet[] = $req[0];
    }

    if(isset($tema) and !empty($tema)){
        if(!in_array($tema, $vet)){
            mysqli_query($con, "insert into Tema(nome) values ('$tema')") or die("Erro: " . mysqli_error($con));
        }
    }
    header("location:../gerencia.php");
    mysqli_close($con);
?>
