<?php
    session_start();
    include "dbconfig.php";
    $con = mysqli_connect($db_ip, $db_user , $db_password) or die ("Sem conexão com o servidor: " . mysqli_error($con));
    $select = mysqli_select_db($con, $db_name) or die("Sem conexão com o banco de dados: " . mysqli_error($con));

    $alogin = $_SESSION["login"];
    $asenha = $_SESSION["senha"];

    $cod = mysqli_fetch_assoc(mysqli_query($con, "select cod from Usuario where usuario = '$alogin' and senha = '$asenha'"))["cod"];
    $nome = $_POST["nome"];
    $nlogin = $_POST["login"];

    if( isset($_POST["senha1"]) and isset($_POST["senha2"]) ) {
        $nsenha1 = $_POST["senha1"];
        $nsenha2 = $_POST["senha2"];
        if( !empty($nsenha1) and !empty($nsenha2) and $nsenha1 == $nsenha2){
            $chave = md5("4376757d394d5e6f7941235c294b29257366333a5d472f517e793a7c3b");
            $senhacrip = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $chave, $nsenha1, MCRYPT_MODE_ECB);
            $senhacod = base64_encode($senhacrip);
            mysqli_query($con, "update Usuario set usuario = '$nlogin', nome = '$nome', senha = '$senhacod' where cod = $cod") or die("problema1:" .mysqli_error($con));
            $_SESSION["login"] = $nlogin;
            $_SESSION["senha"] = $senhacod;
        }
        else {
            echo(json_encode(true));
        }
    }
    else{
        mysqli_query($con, "update Usuario set usuario = '$nlogin', nome = '$nome' where cod = $cod ") or die("problema2:" .mysqli_error($con));
        $_SESSION["login"] = $nlogin;
    }

    mysqli_close();
?>
