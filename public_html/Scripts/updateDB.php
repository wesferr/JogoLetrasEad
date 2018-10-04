<?php
    $vet = $_POST;
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user , $db_password) or die ("Sem conexão com o servidor: " . mysqli_error($con));
    $select = mysqli_select_db($con, $db_name) or die("Sem conexão com o banco de dados: " . mysqli_error($con));

    $update = $_POST["update"];
    if(!empty($_POST["codperg"])){
        $codperg = $_POST["codperg"];
    }
    $tema = utf8_decode($_POST['tema']);
    $per = utf8_decode($_POST['per']);
    $feedbackPositivo = utf8_decode($_POST['feedbackPositivo']);
    $feedbackNegativo = utf8_decode($_POST['feedbackNegativo']);
    $res1 = utf8_decode($_POST['resp1']);
    $res2 = utf8_decode($_POST['resp2']);
    $res3 = utf8_decode($_POST['resp3']);
    $res4 = utf8_decode($_POST['resp4']);
    $res1long = utf8_decode($_POST['resp1longa']);
    $res2long = utf8_decode($_POST['resp2longa']);
    $res3long = utf8_decode($_POST['resp3longa']);
    $res4long = utf8_decode($_POST['resp4longa']);


    if($update == "add"){
        if( empty($_POST["tema"]) or empty($_POST["resp1"]) or empty($_POST["resp2"]) or empty($_POST["resp3"]) or empty($_POST["resp1"]) ){
            header('location:../campos.php');
        }
        $codtema = mysqli_fetch_assoc( mysqli_query($con, "select cod from Tema where Tema.nome = '$tema'") );
        $codtema = $codtema['cod'];
        mysqli_query($con, "insert into Pergunta (tema,descricao, feedbackPositivo, feedbackNegativo) values ($codtema, '$per', '$feedbackPositivo', '$feedbackNegativo')") or die("Erro: " . mysqli_error($con));
        $codperg = mysqli_fetch_assoc(mysqli_query($con, "select cod from Pergunta where Pergunta.descricao = '$per'"));
        $codperg = $codperg['cod'];
        mysqli_query($con, "insert into Resposta (respCurta, respLonga, pergunta, certa) values('$res1', '$res1long', $codperg,1)");
        mysqli_query($con, "insert into Resposta (respCurta, respLonga, pergunta, certa) values('$res2', '$res2long', $codperg,0)");
        mysqli_query($con, "insert into Resposta (respCurta, respLonga, pergunta, certa) values('$res3', '$res3long', $codperg,0)");
        mysqli_query($con, "insert into Resposta (respCurta, respLonga, pergunta, certa) values('$res4', '$res4long', $codperg,0)");

    }
    if($update == "edit"){
        if( empty($_POST["tema"]) or empty($_POST["resp1"]) or empty($_POST["resp2"]) or empty($_POST["resp3"]) or empty($_POST["resp1"]) ){
            header('location:../campos.php');
        }
        mysqli_query($con, "update Pergunta set descricao = '$per', feedbackPositivo = '$feedbackPositivo', feedbackNegativo = '$feedbackNegativo' where Pergunta.cod = $codperg");
        $req = mysqli_query($con, "select codAlt from Resposta where pergunta = $codperg") or die ( "Erro: " . mysqli_error($con));
        $vet = array();
        while($res = mysqli_fetch_assoc($req)){
            $vet[] = $res;
        }
        $cod1 = $vet[0]['codAlt'];
        $cod2 = $vet[1]['codAlt'];
        $cod3 = $vet[2]['codAlt'];
        $cod4 = $vet[3]['codAlt'];

        mysqli_query($con, "UPDATE Resposta SET respCurta = '$res1', respLonga = '$res1long' WHERE codAlt=$cod1") or die ( "Erro1: " . mysqli_error($con));
        mysqli_query($con, "UPDATE Resposta SET respCurta = '$res2', respLonga = '$res2long' WHERE codAlt=$cod2") or die ( "Erro2: " . mysqli_error($con));
        mysqli_query($con, "UPDATE Resposta SET respCurta = '$res3', respLonga = '$res3long' WHERE codAlt=$cod3") or die ( "Erro3: " . mysqli_error($con));
        mysqli_query($con, "UPDATE Resposta SET respCurta = '$res4', respLonga = '$res4long' WHERE codAlt=$cod4") or die ( "Erro4: " . mysqli_error($con));
    }
    header('location:../gerencia.php');
?>
