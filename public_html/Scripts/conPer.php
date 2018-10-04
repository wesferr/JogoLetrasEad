<?php
    session_start();
    include "dbconfig.php";
    $_SESSION['removidos'] = 0;
    $_SESSION["vRemovidos"] = array();
    header('Content-Type: text/html; charset=utf-8');

    $con = mysqli_connect($db_ip, $db_user, $db_password);
    
    if (!$con) {
    
        die("Erro ao se conectar ao servidor: " . mysqli_error($con));
        
    } else {
    
        mysqli_select_db($con, $db_name);
    
        if(!$con){
        
            die("Erro ao selecionar o banco de dados: " . mysqli_error($con));
            
        } else {
        
            mysqli_query($con, 'SET character_set_results=utf8');
            $cod = $_POST['cod'];
            $req = mysqli_query($con, "SELECT * FROM Pergunta inner join Resposta where Pergunta.cod = Resposta.pergunta and Pergunta.cod = $cod");
            if (!$req) {
            
                echo 'Não foi possivel realizar consulta: ' . mysqli_error($con);
                
            } else {
                $vet = array();
                while($res = mysqli_fetch_assoc($req)){
                    $vet[] = $res;
                }
                $r1 = array(
                    'resCur' => $vet[0]['respCurta'],
                    'resLon' => $vet[0]['respLonga'],
                    'codres' => $vet[0]['codAlt']
                );
                $r2 = array(
                    'resCur' => $vet[1]['respCurta'],
                    'resLon' => $vet[1]['respLonga'],
                    'codres' => $vet[1]['codAlt']
                );
                $r3 = array(
                    'resCur' => $vet[2]['respCurta'],
                    'resLon' => $vet[2]['respLonga'],
                    'codres' => $vet[2]['codAlt']
                );
                $r4 = array(
                    'resCur' => $vet[3]['respCurta'],
                    'resLon' => $vet[3]['respLonga'],
                    'codres' => $vet[3]['codAlt']
                );
                
                $resps = array($r1,$r2,$r3,$r4);
                
                $res = array(
                'codPerg' => $vet[0]['pergunta'],
                'descricao' => $vet[0]['descricao'],
                'feedbackPositivo' => $vet[0]['feedbackPositivo'],
                'feedbackNegativo' => $vet[0]['feedbackNegativo'],
                $resps[0],
                $resps[1],
                $resps[2],
                $resps[3]
                );
                echo json_encode($res);
                
            }
            
        }
        
    }
    mysqli_close($con);
    
?>
