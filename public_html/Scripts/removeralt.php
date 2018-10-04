<?php
    session_start();
    
    header('Content-Type: text/html; charset=utf-8');

    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user, $db_password);
    
    if (!$con) {
    
        die("Erro ao se conectar ao servidor: " . mysqli_error($con));
        
    } else {
    
        mysqli_select_db($con, $db_name);
    
        if(!$con){
        
            die("Erro ao selecionar o banco de dados: " . mysqli_error($con));
            
        } else {
        
            if($_SESSION["removidos"] < 2){
            mysqli_query('SET character_set_results=utf8');
            $pergunta = $_POST['pergunta'];
            $req = mysqli_query($con, "SELECT codAlt FROM Pergunta INNER JOIN Resposta WHERE Pergunta.cod = $pergunta and Resposta.certa = 0 and Pergunta.cod = Resposta.pergunta");
            $vet = array();
            while($res = mysqli_fetch_assoc($req)){
                $vet[] = $res;
            }
            $rand_key = array_rand($vet, 1);
            while(in_array($vet[$rand_key], $_SESSION["vRemovidos"])){
                $rand_key = array_rand($vet, 1);
            }
            $_SESSION["removidos"] += 1;
            $_SESSION["vRemovidos"][] = $vet[$rand_key];
            echo json_encode($vet[$rand_key]);
            } else {
                echo json_encode(array("codAlt" => -1));
            }
        }
           
    }
?>
