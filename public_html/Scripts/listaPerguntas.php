<?php
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
        
            $per = $_POST['perg'];
            $tem = $_POST['tem'];
            mysqli_query($con, 'SET character_set_results=utf8');
            $req = mysqli_query($con, "select Pergunta.cod, descricao from Pergunta inner join Tema on Pergunta.tema = Tema.cod where Tema.nome like '%$tem%' and Pergunta.descricao like '%$per%'"
            );
            
            if (!$req) {
            
                echo 'Não foi possivel realizar consulta: ' . mysqli_error($con);
                
            } else {
                
                //echo json_encode($req);
                
                $vet = array();
                while($res = mysqli_fetch_assoc($req)){
                    $vet[] = $res;
                }
                
                echo json_encode($vet);
                
            }
            
        }
        
    }
    mysqli_close($con);

?>
