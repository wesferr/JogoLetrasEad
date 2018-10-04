<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user, $db_password);
    
    if (!$con) {
    
        die("Erro ao se conectar ao servidor: " . mysqli_error($con));
        
    } else {
    
        mysqli_select_db($con, $db_name);
    
        if(!$con){
        
            die("Erro ao selecionar o banco de dados: " . mysqli_error($con));
            
        } else {
        
            mysqli_query($con, 'SET character_set_results=utf8');
            $codResp = $_POST['codResp'];
            $codPerg = $_POST['codPerg'];
            $req = mysqli_query($con, "SELECT codAlt,certa FROM Resposta where Resposta.pergunta = $codPerg and certa = 1");
            $req2 = mysqli_query($con, "SELECT codAlt,certa FROM Resposta where Resposta.codAlt = $codResp and certa = 1");
            $req2 = mysqli_fetch_row($req2);
            while($res = mysqli_fetch_assoc($req)){
                $vet[] = $res;
            }
            if($req2[1]){
                $val = array(
                'acertou' => $req2[1] ? true:false,
                'certa' => $req2[0]
                );
                $usr = $_SESSION['login'];
                mysqli_query($con, "UPDATE Usuario set acertos = acertos + 1 where Usuario.usuario = '$usr'");
                mysqli_query($con, "UPDATE Usuario set pontos = pontos + 20 where Usuario.usuario = '$usr'");
                echo json_encode($val);
            } else {
                $val = array(
                'acertou' => $req2[1] ? true:false,
                'certa' => $vet[0]['codAlt']
                );
                $usr = $_SESSION['login'];
                mysqli_query($con, "UPDATE Usuario set erros = erros + 1 where Usuario.usuario = '$usr'");
                echo json_encode($val);
            }
        }
        
    }
    mysqli_close($con);
?>
