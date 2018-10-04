<?php
    ini_set( "display_errors", 0); 
    header('Content-Type: text/html; charset=utf-8');
    
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user, $db_password);
    
    if (!$con) {
    
        die("Erro ao se conectar ao servidor: " . mysqli_error($con));
        
    } else {
    
        mysqli_select_db($con, $dn_name);
    
        if(!$con){
        
            die("Erro ao selecionar o banco de dados: " . mysqli_error($con));
            
        } else {
            mysqli_query($con, 'SET character_set_results=utf8');
            $cards = mysqli_query($con, "SELECT nome, cod FROM Tema");
            if (!$cards) {
            
                echo 'Não foi possivel realizar consulta: ' . mysqli_error($con);
                
            } else {
            
                while($res = mysqli_fetch_row($cards)){
                        echo "<option value = '$res[0]'>$res[0]</option>";
                }
                
            }
        }
        
    }
    mysqli_close($con);
?>
