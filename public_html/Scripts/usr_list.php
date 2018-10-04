<?php
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user , $db_password) or die ("Sem conexão com o servidor: " . mysqli_error($con));
    $select = mysqli_select_db($con, $db_name) or die("Sem conexão com o banco de dados: " . mysqli_error($con));
    
    $req = mysqli_query($con, "select nome, pontos from Usuario order by pontos desc");
    $vet = array();
    
    echo("<tr><th>Nome</th><th>Pontos</th></tr>");
    while ( $res = mysqli_fetch_row($req) ){
        echo("<tr><td>$res[0]</td><td>$res[1]</td></tr>");
    }
?>
